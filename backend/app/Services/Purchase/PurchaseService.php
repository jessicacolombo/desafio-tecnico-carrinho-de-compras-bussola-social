<?php

namespace App\Services\Purchase;

use App\Domain\Payment;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Services\PaymentMethod\PaymentMethodServiceInterface;
use Illuminate\Support\Collection;

// Strategy
class PurchaseService implements PurchaseServiceInterface
{
    public function __construct(
        protected PurchaseRepositoryInterface $repository,
        protected ProductRepositoryInterface $productRepository,
        protected Collection $paymentMethods,
        public PaymentMethodServiceInterface|null $paymentProcessor = null,
        protected float $subtotal = 0,
        protected Payment|null $payment = null
    ) {}

    public function setPaymentProcessor(string $paymentMethodKey)
    {
        try {
            if (!$this->paymentMethods->has($paymentMethodKey)) {
                throw new \InvalidArgumentException("Payment method not found: " . $paymentMethodKey);
            }
            $this->paymentProcessor = $this->paymentMethods->get($paymentMethodKey);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function store(array $data)
    {
        $this->setPaymentProcessor($data['payment_method']);

        $this->payment = $this->processPurchase(
            $data['products'],
            $data['installments']
        );

        if (!isset($data['products'])) {
            throw new \InvalidArgumentException("Dados incompletos para criar a compra.");
        }

        if (!is_array($data['products']) || empty($data['products'])) {
            throw new \InvalidArgumentException("A lista de produtos não pode estar vazia.");
        }

        return $this->repository->create([
            'products' => $data['products'],
            'payment' => $this->payment,
        ]);
    }

    public function calculateSubtotal(array $items): float
    {
        return array_reduce(
            $items,
            function ($carry, $item) {
                $product = $this->productRepository->findById($item['id']);

                if (!$product) {
                    throw new \InvalidArgumentException("Product not found: " . $item['id']);
                }

                if ($item['quantity'] <= 0) {
                    throw new \InvalidArgumentException("Invalid quantity for product: " . $item['id']);
                }

                return $carry + ($product->price->value * $item['quantity']);
            },
            0
        );
    }

    public function processPurchase(array $items, int $installments): Payment
    {
        if (!$this->paymentProcessor) {
            throw new \RuntimeException("Processador de pagamento não foi definido.");
        }

        $this->subtotal = $this->calculateSubtotal($items);

        return $this->paymentProcessor->processPayment($this->subtotal, $installments);
    }
}

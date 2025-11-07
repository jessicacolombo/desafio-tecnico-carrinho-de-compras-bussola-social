<?php

namespace App\Services\Purchase;

use App\Domain\Payment;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Purchase\PurchaseRepositoryInterface;
use Illuminate\Support\Collection;

// Strategy
class PurchaseService implements PurchaseServiceInterface
{
    public function __construct(
        protected PurchaseRepositoryInterface $repository,
        protected ProductRepositoryInterface $productRepository,
        protected Collection $paymentMethods,
        protected $paymentProcessor = null,
        protected float $subtotal = 0,
        protected Payment|null $payment = null
    ) {}

    public function setPaymentProcessor(string $paymentMethodKey)
    {
        $this->paymentProcessor = $this->paymentMethods->get($paymentMethodKey);
    }

    public function store(array $data)
    {
        $this->setPaymentProcessor($data['payment_method']);

        $this->payment = $this->processPurchase(
            $data['products'],
            $data['installments']
        );

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

                return $carry + ($product->price->value * $item['quantity']);
            },
            0
        );
    }

    public function processPurchase(array $items, int $installments): Payment
    {
        $this->subtotal = $this->calculateSubtotal($items);

        return $this->paymentProcessor->processPayment($this->subtotal, $installments);
    }
}

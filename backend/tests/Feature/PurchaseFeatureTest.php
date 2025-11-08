<?php

namespace Tests\Feature;

use App\Domain\Payment;
use App\Domain\Product;
use App\Domain\Purchase;
use App\Domain\ValueObjects\Money;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Services\PaymentMethod\PaymentMethodServiceInterface;
use App\Services\Purchase\PurchaseService;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class PurchaseFeatureTest extends TestCase
{
    private $purchaseRepository;
    private $productRepository;
    private $paymentProcessor;
    private $paymentMethods;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->purchaseRepository = $this->createMock(PurchaseRepositoryInterface::class);
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $this->paymentProcessor = $this->createMock(PaymentMethodServiceInterface::class);

        $this->paymentMethods = collect([
            'credit_card' => $this->paymentProcessor,
            'pix' => $this->paymentProcessor
        ]);

        $this->service = new PurchaseService(
            $this->purchaseRepository,
            $this->productRepository,
            $this->paymentMethods
        );
    }

    public function testShouldCreatePurchaseSuccessfully()
    {
        $data = [
            'products' => [
                ['id' => 1, 'quantity' => 2]
            ],
            'payment_method' => 'credit_card',
            'installments' => 12
        ];

        $product = new Product(1, 'Product 1', Money::from(1000), 'Description 1');
        $expectedPayment = new Payment(
            'credit_card',
            12,
            Money::from(2000),
            Money::from(253),
            Money::from(2253),
            Money::from(0),
            Money::from(187)
        );

        $expectedPurchase = new Purchase(
            products: $data['products'],
            payment: $expectedPayment
        );

        $this->productRepository
            ->method('findById')
            ->willReturn($product);

        $this->paymentProcessor
            ->method('processPayment')
            ->willReturn($expectedPayment);

        $this->purchaseRepository
            ->expects($this->once())
            ->method('create')
            ->with([
                'products' => $data['products'],
                'payment' => $expectedPayment
            ])
            ->willReturn($expectedPurchase);

        $result = $this->service->store($data);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Purchase::class, $result);
        $this->assertEquals($expectedPurchase, $result);
    }

    public function testProcessPurchaseWithPix()
    {
        $items = [
            ['id' => 1, 'quantity' => 2]
        ];

        $product = new Product(1, 'Product 1', Money::from(1000), 'Description 1');
        $expectedPayment = new Payment(
            'pix',
            1,
            Money::from(2000),
            Money::from(0),
            Money::from(1800),
            Money::from(200),
            Money::from(1800)
        );

        $this->productRepository
            ->method('findById')
            ->willReturn($product);

        $this->service->setPaymentProcessor('pix');

        $this->paymentProcessor
            ->expects($this->once())
            ->method('processPayment')
            ->with(2000, 1)
            ->willReturn($expectedPayment);


        $result = $this->service->processPurchase($items, 1);

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertEquals($expectedPayment, $result);
    }

    public function testProcessPurchaseWithCreditCard()
    {
        $items = [
            ['id' => 1, 'quantity' => 2]
        ];

        $product = new Product(1, 'Product 1', Money::from(1000), 'Description 1');
        $expectedPayment = new Payment(
            'credit_card',
            12,
            Money::from(2000),
            Money::from(253),
            Money::from(2253),
            Money::from(0),
            Money::from(187)
        );

        $this->productRepository
            ->method('findById')
            ->willReturn($product);

        $this->service->setPaymentProcessor('credit_card');

        $this->paymentProcessor
            ->expects($this->once())
            ->method('processPayment')
            ->with(2000, 12)
            ->willReturn($expectedPayment);

        $result = $this->service->processPurchase($items, 12);

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertEquals($expectedPayment, $result);
    }
}

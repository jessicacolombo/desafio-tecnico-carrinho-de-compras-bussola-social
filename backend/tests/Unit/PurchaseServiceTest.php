<?php

namespace Tests\Unit;

use App\Domain\Payment;
use App\Domain\Product;
use App\Domain\Purchase;
use App\Domain\ValueObjects\Money;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Services\PaymentMethod\PaymentMethodServiceInterface;
use App\Services\Purchase\PurchaseService;
use PHPUnit\Framework\TestCase;

class PurchaseServiceTest extends TestCase
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

    public function testSetPaymentProcessorShouldSetCorrectProcessor()
    {
        $this->service->setPaymentProcessor('credit_card');
        $this->assertNotNull($this->service->paymentProcessor);
        $this->assertInstanceOf(PaymentMethodServiceInterface::class, $this->service->paymentProcessor);
    }

    public function testSetPaymentProcessorShouldThrowExceptionWhenPaymentMethodNotFound()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->setPaymentProcessor('invalid_method');
    }

    public function testCalculateSubtotalShouldReturnCorrectValue()
    {
        $product1 = new Product(1, 'Product 1', Money::from(1000), 'Description 1');
        $product2 = new Product(2, 'Product 2', Money::from(2000), 'Description 2');

        $this->productRepository
            ->method('findById')
            ->willReturnMap([
                [1, $product1],
                [2, $product2]
            ]);

        $items = [
            ['id' => 1, 'quantity' => 2],
            ['id' => 2, 'quantity' => 1]
        ];

        $subtotal = $this->service->calculateSubtotal($items);
        $expectedTotal = (1000 * 2) + (2000 * 1);

        $this->assertEquals($expectedTotal, $subtotal);
    }

    public function testCalculateSubtotalShouldThrowExceptionWhenProductNotFound()
    {
        $this->productRepository
            ->method('findById')
            ->willReturn(null);

        $items = [
            ['id' => 999, 'quantity' => 1]
        ];

        $this->expectException(\InvalidArgumentException::class);
        $this->service->calculateSubtotal($items);
    }

    public function testCalculateSubtotalShouldThrowExceptionWhenQuantityIsInvalid()
    {
        $product = new Product(1, 'Product 1', Money::from(1000), 'Description 1');

        $this->productRepository
            ->method('findById')
            ->willReturn($product);

        $items = [
            ['id' => 1, 'quantity' => -1]
        ];

        $this->expectException(\InvalidArgumentException::class);
        $this->service->calculateSubtotal($items);
    }

    public function testCalculateSubtotalShouldReturnZeroWhenCartIsEmpty()
    {
        $subtotal = $this->service->calculateSubtotal([]);
        $this->assertEquals(0, $subtotal);
    }

    public function testProcessPurchaseShouldThrowExceptionWhenProcessorNotSet()
    {
        $items = [
            ['id' => 1, 'quantity' => 1]
        ];

        $this->expectException(\RuntimeException::class);
        $this->service->processPurchase($items, 1);
    }

    public function testProcessPurchaseShouldThrowExceptionWhenInstallmentsIsInvalid()
    {
        $items = [
            ['id' => 1, 'quantity' => 1]
        ];

        $this->service->setPaymentProcessor('credit_card');

        $this->expectException(\InvalidArgumentException::class);
        $this->service->processPurchase($items, -1);
    }


    public function testStoreShouldThrowExceptionWhenDataIsInvalid()
    {
        $invalidData = [
            'products' => [],
            'payment_method' => 'credit_card',
            'installments' => 12
        ];

        $this->expectException(\InvalidArgumentException::class);
        $this->service->store($invalidData);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}

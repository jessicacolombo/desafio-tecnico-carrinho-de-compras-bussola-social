<?php

namespace Tests\Unit;

use App\Domain\Payment;
use App\Services\PaymentMethod\PixPaymentService;
use PHPUnit\Framework\TestCase;

class PixPaymentServiceTest extends TestCase
{
    private PixPaymentService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PixPaymentService();
    }

    protected function calculateExpectedDiscount(float $amount): float
    {
        return $amount * 0.1;
    }

    public function testProcessPaymentShouldApplyDiscount()
    {
        $amount = 1000;

        $expectedDiscount = $this->calculateExpectedDiscount($amount);
        $expectedTotal = $amount - $expectedDiscount;

        $payment = $this->service->processPayment($amount);

        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals('pix', $payment->method);
        $this->assertEquals(1, $payment->installments);
        $this->assertEquals($amount, $payment->amount->value);
        $this->assertEquals($expectedDiscount, $payment->discount->value);
        $this->assertEquals($expectedTotal, $payment->total->value);
        $this->assertEquals($expectedTotal, $payment->installmentValue->value);
        $this->assertEquals(0, $payment->taxes->value);
    }

    public function testProcessPaymentWithZeroAmountShouldWork()
    {
        $amount = 0;

        $payment = $this->service->processPayment($amount);

        $this->assertEquals(0, $payment->total->value);
        $this->assertEquals(0, $payment->discount->value);
        $this->assertEquals(0, $payment->taxes->value);
        $this->assertEquals(0, $payment->installmentValue->value);
    }

    public function testProcessPaymentShouldIgnoreInstallments()
    {
        $amount = 1000;
        $installments = 12;

        $payment = $this->service->processPayment($amount, $installments);

        $this->assertEquals(1, $payment->installments);
    }

    /**
     * @dataProvider invalidAmountProvider
     */
    public function testProcessPaymentShouldValidateAmount(float $invalidAmount)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->processPayment($invalidAmount);
    }

    public static function invalidAmountProvider(): array
    {
        return [
            'negative amount' => [-100],
        ];
    }

    public function testProcessPaymentShouldCalculateCorrectValues()
    {
        $amount = 150000;

        $expectedDiscount = $this->calculateExpectedDiscount($amount);
        $expectedTotal = $amount - $expectedDiscount;

        $payment = $this->service->processPayment($amount);

        $this->assertEquals($amount, $payment->amount->value);
        $this->assertEquals($expectedDiscount, $payment->discount->value);
        $this->assertEquals($expectedTotal, $payment->total->value);
        $this->assertEquals($expectedTotal, $payment->installmentValue->value);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
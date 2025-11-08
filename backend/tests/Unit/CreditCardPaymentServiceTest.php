<?php

namespace Tests\Unit;

use App\Domain\Payment;
use App\Domain\ValueObjects\Money;
use App\Services\PaymentMethod\CreditCardPaymentService;
use PHPUnit\Framework\TestCase;

class CreditCardPaymentServiceTest extends TestCase
{
    private CreditCardPaymentService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CreditCardPaymentService();
    }

    protected function calculateExpectedTotalWithInterest(float $amount, int $installments, float $interestRate = 0.01): float
    {
        // M = P * (1 + i)^n

        return round($amount * (1 + $interestRate) ** $installments);
    }

    protected function calculateExpectedInstallmentValue(float $total, int $installments): float
    {
        return round($total / $installments);
    }

    protected function calculateDiscountForOneInstallment(float $amount): float
    {
        return $amount * 0.1;
    }

    public function testProcessPaymentWithOneInstallmentShouldApplyDiscount()
    {
        $amount = 1000;
        $installments = 1;

        $expectedDiscount = $this->calculateDiscountForOneInstallment($amount);
        $expectedTotal = $amount - $expectedDiscount;

        $payment = $this->service->processPayment($amount, $installments);

        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals('credit_card', $payment->method);
        $this->assertEquals(1, $payment->installments);
        $this->assertEquals($amount, $payment->amount->value);
        $this->assertEquals($expectedDiscount, $payment->discount->value);
        $this->assertEquals($expectedTotal, $payment->total->value);
        $this->assertEquals($expectedTotal, $payment->installmentValue->value);
        $this->assertEquals(0, $payment->taxes->value);
    }

    public function testProcessPaymentWithMultipleInstallmentsShouldApplyInterest()
    {
        $amount = 2000;
        $installments = 12;

        $expectedTotal = $this->calculateExpectedTotalWithInterest($amount, $installments);
        $expectedTaxes = $expectedTotal - $amount;
        $expectedInstallmentValue = $this->calculateExpectedInstallmentValue(
            $expectedTotal,
            $installments
        );

        $payment = $this->service->processPayment($amount, $installments);

        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals('credit_card', $payment->method);
        $this->assertEquals(12, $payment->installments);
        $this->assertEquals($amount, $payment->amount->value);
        $this->assertEquals(0, $payment->discount->value);
        $this->assertEquals($expectedTotal, $payment->total->value);
        $this->assertEquals($expectedTaxes, $payment->taxes->value);
        $this->assertEquals($expectedInstallmentValue, $payment->installmentValue->value);
    }

    public function testProcessPaymentShouldCalculateCorrectInstallmentValue()
    {
        $amount = 100000;
        $installments = 2;

        $expectedTotal = $this->calculateExpectedTotalWithInterest($amount, $installments);
        $expectedTaxes = $expectedTotal - $amount;
        $expectedInstallmentValue = $this->calculateExpectedInstallmentValue(
            $expectedTotal,
            $installments
        );

        $payment = $this->service->processPayment($amount, $installments);

        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals('credit_card', $payment->method);
        $this->assertEquals(2, $payment->installments);
        $this->assertEquals($amount, $payment->amount->value);
        $this->assertEquals(0, $payment->discount->value);
        $this->assertEquals($expectedTotal, $payment->total->value);
        $this->assertEquals($expectedTaxes, $payment->taxes->value);
        $this->assertEquals($expectedInstallmentValue, $payment->installmentValue->value);
    }

    public function testProcessPaymentWithZeroAmountShouldWork()
    {
        $amount = 0;
        $installments = 1;

        $payment = $this->service->processPayment($amount, $installments);

        $this->assertEquals(0, $payment->total->value);
        $this->assertEquals(0, $payment->discount->value);
        $this->assertEquals(0, $payment->taxes->value);
        $this->assertEquals(0, $payment->installmentValue->value);
    }

    /**
     * @dataProvider invalidInstallmentsProvider
     */
    public function testProcessPaymentShouldValidateInstallments(int $invalidInstallments)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->processPayment(1000, $invalidInstallments);
    }

    public static function invalidInstallmentsProvider(): array
    {
        return [
            'negative installments' => [-1],
            'zero installments' => [0],
            'more than 12 installments' => [13],
        ];
    }

    /**
     * @dataProvider invalidAmountProvider
     */
    public function testProcessPaymentShouldValidateAmount(float $invalidAmount)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->processPayment($invalidAmount, 1);
    }

    public static function invalidAmountProvider(): array
    {
        return [
            'negative amount' => [-100],
        ];
    }


    public function tearDown(): void
    {
        parent::tearDown();
    }
}

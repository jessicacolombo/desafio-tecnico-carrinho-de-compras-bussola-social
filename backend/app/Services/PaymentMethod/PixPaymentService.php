<?php

namespace App\Services\PaymentMethod;

use App\Domain\Payment;
use App\Domain\ValueObjects\Money;

class PixPaymentService implements PaymentMethodServiceInterface
{
    public function __construct(
        protected float $amount = 0,
        protected float $total = 0,
        protected float $discount = 0
    ) {}

    public function processPayment(float $amount, int $installments = 1): Payment
    {
        $this->calculateTotal($amount);

        return new Payment(
            method: 'pix',
            installments: 1,
            amount: Money::from($amount),
            taxes: Money::from(0),
            total: Money::from($this->total),
            discount: Money::from($this->discount),
            installmentValue: Money::from($this->total)
        );
    }

    protected function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    protected function setTotal(): void
    {
        $this->total = $this->amount - $this->discount;
    }

    protected function setDiscount(): void
    {
        $this->discount = $this->calculatePixDiscount($this->amount);
    }

    protected function calculatePixDiscount(float $amount): float
    {
        return $amount * 0.1;
    }

    protected function calculateTotal(float $amount): void
    {
        $this->setAmount($amount);

        $this->setDiscount();

        $this->setTotal();
    }
}

<?php

namespace App\Services\PaymentMethod;

use App\Domain\Payment;
use App\Domain\ValueObjects\Money;

class CreditCardPaymentService implements PaymentMethodServiceInterface
{
    public function __construct(
        protected float $amount = 0,
        protected float $total = 0,
        protected float $discount = 0,
        protected float $taxes = 0,
        protected int $installments = 1,
        protected float $installmentValue = 0,
        protected float $interestRate = 0.01
    ) {}

    public function processPayment(float $amount, int $installments): Payment
    {
        if ($installments <= 0 || $installments > 12) {
            throw new \InvalidArgumentException("Número de parcelas inválido.");
        }

        if ($amount < 0) {
            throw new \InvalidArgumentException("Valor do pagamento inválido.");
        }

        $this->calculateTotal($amount, $installments);

        return new Payment(
            method: 'credit_card',
            installments: $this->installments,
            installmentValue: Money::from($this->installmentValue),
            amount: Money::from($this->amount),
            taxes: Money::from($this->taxes),
            total: Money::from($this->total),
            discount: Money::from($this->discount),
        );
    }

    protected function setInstallments(int $installments): void
    {
        $this->installments = $installments;
    }

    protected function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    protected function setTotal(float $total): void
    {
        $this->total = $total;
    }

    protected function setDiscount(float $amount): void
    {
        if ($this->installments === 1) {
            $this->discount = $this->calculateCashDownDiscount($amount);
        }
    }

    protected function setTaxes(float $taxes): void
    {
        $this->taxes = $taxes;
    }

    protected function setInstallmentValue(float $installmentValue): void
    {
        $this->installmentValue = $installmentValue;
    }

    protected function calculateTotal(float $amount, int $installments): void
    {
        $this->setInstallments($installments);

        $this->setAmount($amount);

        $this->setDiscount($amount);

        if ($this->installments === 1) {
            $this->setTotal(
                $this->calculateAmountCashdownPayment($this->amount)
            );
            $this->setInstallmentValue($this->total);
        } else {
            $this->setTotal(
                $this->calculateAmountWithInterest($this->amount)
            );

            $this->setInstallmentValue(
                round($this->total / $this->installments)
            );
        }
    }

    protected function calculateCashDownDiscount(float $amount): float
    {
        return $amount * 0.1;
    }

    protected function calculateAmountCashdownPayment(float $amount): float
    {
        return $amount - $this->calculateCashDownDiscount($amount);
    }

    protected function calculateAmountWithInterest(float $amount): float
    {
        $amountWithInterest = round($amount * (1 + $this->interestRate) ** $this->installments);

        $this->setTaxes($amountWithInterest - $amount);

        return $amountWithInterest;
    }
}

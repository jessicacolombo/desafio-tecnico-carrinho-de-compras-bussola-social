<?php

namespace App\Domain;

use App\Domain\ValueObjects\Money;
use App\Enums\PaymentMethods;

class Payment
{
    public function __construct(
        public string $method,
        public int $installments,
        public Money $amount,
        public Money $taxes,
        public Money $total,
        public Money $discount,
        public Money $installmentValue
    ) {}

    /**
     * Serializa o objeto.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'amount' => $this->amount,
            'taxes' => $this->taxes,
            'total' => $this->total,
            'discount' => $this->discount,
            'paymentMethod' => PaymentMethods::from($this->method),
            'installments' => [
                'count' => $this->installments,
                'installmentValue' => $this->installmentValue
            ]
        ];
    }
}

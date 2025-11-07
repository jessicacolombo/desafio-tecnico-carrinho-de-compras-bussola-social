<?php

namespace App\Domain;

class Purchase
{
    public function __construct(
        public array $products,
        public Payment $payment
    ) {}

    /**
     * Serializa o objeto.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'products' => $this->products,
            'payment' => $this->payment,
        ];
    }
}

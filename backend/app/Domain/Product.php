<?php

namespace App\Domain;

use App\Domain\ValueObjects\Money;

class Product
{
    public function __construct(
        public int $id,
        public string $name,
        public Money $price,
        public string $description,
    ) {}

    /**
     * Serializa o objeto.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description
        ];
    }
}

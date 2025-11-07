<?php

namespace App\Domain\ValueObjects;

final class Money
{
    public function __construct(
        public int $value,
        public string|null $formatted = null
    ) {
        $this->formatted = $this->formatted();
    }

    /**
     * Método estático para criar uma instância de Money a partir de um
     * valor inteiro (centavos).
     *
     * @param float|string $amount
     * @return Money
     */
    public static function from(float|string $amount): self
    {
        return new self($amount);
    }

    /**
     * Converte o valor em centavos para um valor em reais (float).
     *
     * @return float
     */
    public function to(): float
    {
        return $this->value / 100;
    }

    /**
     * Formata o valor em centavos para reais, considerando o formato
     * monetario local.
     *
     * @return string
     */
    public function formatted(): string
    {
        return number_format($this->to(), 2, ',', '.');
    }
}

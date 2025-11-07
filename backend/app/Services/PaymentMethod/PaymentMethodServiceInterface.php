<?php

namespace App\Services\PaymentMethod;

use App\Domain\Payment;

interface PaymentMethodServiceInterface
{
    public function processPayment(float $amount, int $installments): Payment;
}

<?php

namespace App\Services\Purchase;

interface PurchaseServiceInterface
{
    public function setPaymentProcessor(string $paymentMethodKey);
    public function store(array $data);
    public function calculateSubtotal(array $items): float;
    public function processPurchase(array $items, int $installments);
}

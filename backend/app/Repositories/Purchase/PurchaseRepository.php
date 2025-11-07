<?php

namespace App\Repositories\Purchase;

use App\Domain\Purchase;

class PurchaseRepository implements PurchaseRepositoryInterface
{

    public function __construct() {}

    public function create(array $data)
    {
        return new Purchase(
            products: $data['products'],
            payment: $data['payment']
        );
    }
}

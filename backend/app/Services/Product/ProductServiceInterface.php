<?php

namespace App\Services\Product;

use Illuminate\Support\Collection;

interface ProductServiceInterface
{
    public function all(): Collection;
    public function findById(int $id);
}

<?php

namespace App\Repositories\Product;

use App\Domain\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;
    public function findById(int $id): ?Product;
}

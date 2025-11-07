<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductService implements ProductServiceInterface
{
    public function __construct(protected ProductRepositoryInterface $repository) {}

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
}

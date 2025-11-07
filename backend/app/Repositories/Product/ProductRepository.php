<?php

namespace App\Repositories\Product;

use App\Domain\Product;
use App\Domain\ValueObjects\Money;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(public Collection $productsCollection)
    {
        $this->productsCollection = $this->loadProducts();
    }

    public function all(): Collection
    {
        return $this->productsCollection;
    }

    public function findById(int $id): ?Product
    {
        return $this->productsCollection->firstWhere('id', $id);
    }

    protected function loadProducts(): Collection
    {
        return $this->processProductData(
            $this->loadProductsFromFile()
        );
    }

    protected function loadProductsFromFile(): array
    {
        return json_decode(
            file_get_contents(database_path('products.json')),
            true
        );
    }

    protected function processProductData(array $data): Collection
    {
        return collect(array_map(
            fn($product) => $this->mapToModel($product),
            $data
        ));
    }

    protected function mapToModel(array $data): Product
    {
        return new Product(
            $data['id'],
            $data['name'],
            Money::from($data['price']),
            $data['description']
        );
    }
}

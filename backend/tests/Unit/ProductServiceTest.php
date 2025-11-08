<?php

namespace Tests\Unit;

use App\Domain\Product;
use App\Domain\ValueObjects\Money;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Product\ProductService;
use Illuminate\Support\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    private $repository;
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->createMock(ProductRepositoryInterface::class);

        $this->service = new ProductService($this->repository);
    }

    public function testAllMethodShouldReturnCollection()
    {
        $expectedCollection = new Collection([
            new Product(1, 'Product 1', Money::from(1000), 'Description 1'),
            new Product(2, 'Product 2', Money::from(3000), 'Description 2')
        ]);

        $this->repository->expects($this->once())
            ->method('all')
            ->willReturn($expectedCollection);

        $result = $this->service->all();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($expectedCollection, $result);
    }

    public function testFindByIdShouldReturnProduct()
    {
        $expectedProduct = new Product(1, 'Product 1', Money::from(1000), 'Description 1');

        $this->repository->expects($this->once())
            ->method('findById')
            ->with(1)
            ->willReturn($expectedProduct);

        $result = $this->service->findById(1);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($expectedProduct, $result);
    }

    public function testFindByIdShouldReturnNullWhenProductNotFound()
    {
        $this->repository->expects($this->once())
            ->method('findById')
            ->with(999)
            ->willReturn(null);


        $result = $this->service->findById(999);

        $this->assertNull($result);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}

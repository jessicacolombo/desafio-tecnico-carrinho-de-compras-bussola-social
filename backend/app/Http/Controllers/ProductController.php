<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductServiceInterface;

class ProductController extends Controller
{
    public function __construct(private ProductServiceInterface $service) {}

    public function index()
    {
        return response()->json($this->service->all());
    }

    public function show(int $id)
    {
        $product = $this->service->findById($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        return response()->json($product);
    }
}

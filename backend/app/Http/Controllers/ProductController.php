<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductServiceInterface;

class ProductController extends Controller
{
    public function __construct(private ProductServiceInterface $service) {}

    /**
     * Listar Produtos
     *
     * @group Produtos
     * @responseFile 200 storage/scribe/responses/ProductsController/index.json
     */
    public function index()
    {
        return response()->json($this->service->all());
    }

    /**
     * Exibir Detalhes do Produto
     *
     * @group Produtos
     * @urlParam id int required ID do Produto. Example: 1
     * @responseFile 200 storage/scribe/responses/ProductsController/show.json
     * @responseFile 404 storage/scribe/responses/ProductsController/not-found.json
     */
    public function show(int $id)
    {
        $product = $this->service->findById($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado.'], 404);
        }

        return response()->json($product);
    }
}

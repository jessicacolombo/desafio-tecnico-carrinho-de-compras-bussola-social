<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Services\Purchase\PurchaseServiceInterface;

class PurchaseController extends Controller
{
    public function __construct(protected PurchaseServiceInterface $service) {}

    /**
     * Registrar uma nova compra
     * @group Compras
     *
     * @responseFile 201 storage/scribe/responses/PurchaseController/store.json
     */
    public function store(StorePurchaseRequest $request)
    {
        $created = $this->service->store($request->validated());

        return response()->json($created, 201);
    }
}

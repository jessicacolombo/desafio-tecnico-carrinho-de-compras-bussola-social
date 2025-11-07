<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Services\Purchase\PurchaseServiceInterface;

class PurchaseController extends Controller
{
    public function __construct(protected PurchaseServiceInterface $service) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        $created = $this->service->store($request->validated());

        return response()->json($created, 201);
    }
}

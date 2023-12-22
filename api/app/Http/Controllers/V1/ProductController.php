<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Actions\PriceAction;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): ProductResource
    {
        return new ProductResource(Product::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, PriceAction $priceAction): ProductResource
    {
        //dd($priceAction->calculateVatPurchasePrice(10.45, 22));
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json([
            'message' => 'Resource deleted successfully'
        ]);
    }
}

<?php

namespace App\Manage\Controllers;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::paginate(15);
        return response()->json($products);
    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->id);
        return response()->json($product);
    }

    public function update(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->id);
        $product->delete();
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|in:milk,tea,other',
            'image_url' => 'nullable|url'
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'quantity' => 'required|integer|min:0',
            'category' => 'required|in:milk,tea,other',
            'image_url' => 'nullable|url'
        ]);

        $product->update($validatedData);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }

    /**
     * Search for a product by name.
     */
    public function search(Request $request)
    {
        $name = $request->query('name');
        $products = Product::where('name', 'like', "%{$name}%")->get();
        return response()->json($products);
    }
}

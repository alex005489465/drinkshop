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
     * Search for a product by name, price.
     */
    public function search(Request $request)
    {
        $name = $request->query('name');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        $products = $this->filterProducts($name, $minPrice, $maxPrice);
        return response()->json($products);
    }

    private function filterProducts($name = null, $minPrice = null, $maxPrice = null)
    {
        $query = Product::query();

        if (!is_null($name) && $name !== '') {
            $query->where('name', 'like', "%{$name}%");
        }

        if (!is_null($minPrice) && $minPrice !== '') {
            $query->where('price', '>=', $minPrice);
        }

        if (!is_null($maxPrice) && $maxPrice !== '') {
            $query->where('price', '<=', $maxPrice);
        }

        return $query->get();
    }
}

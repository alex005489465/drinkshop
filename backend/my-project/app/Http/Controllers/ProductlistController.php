<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        // Call the create method to get categorized and sorted data
        $sortedProducts = $this->create();
        return response()->json($sortedProducts);
    }

    /**
     * Create a list of products with selected fields, categorized and sorted.
     */
    public function create()
    {
        // Call the index method of ProductController
        $productController = app()->make(ProductController::class);
        $products = $productController->index();

        // Keep the required fields
        $filteredProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category,
            ];
        });

        // Categorize by category and sort by category
        $groupedAndSortedProducts = $filteredProducts->groupBy('category')->sortKeys()->map(function ($category) {
            // Sort by name within each category
            return $category->sortBy('name')->values();
        });

        // Convert to the desired JSON format
        return $groupedAndSortedProducts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

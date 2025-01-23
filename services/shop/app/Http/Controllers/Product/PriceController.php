<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Price;

class PriceController extends Controller
{
    public function newinit($product)
    {
        // 新增一條紀錄
        Price::create([
            'product_id' => $product->product_id,
            'price_small' => 0,
            'price_medium' => 0,
            'price_large' => 0,
            'price_xl' => 0,
        ]);
    }

    public function index()
    {
        $prices = Price::all();
        return view('products.prices', compact('prices'));
    }

    public function update(Request $request)
    {
        foreach ($request->prices as $id => $priceData) {
            $price = Price::find($id);
            if ($price) {
                $price->update($priceData);
            }
        }
        return redirect()->route('products.prices.index')->with('success', 'Prices updated successfully');
    }

}

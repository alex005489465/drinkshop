<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Ingredient;
use Illuminate\Support\Facades\Log;

class IngredientController extends Controller
{
    public function index()
    {
        // 確認從資料庫中獲取所有配料資料
        $ingredients = Ingredient::all();
        
        // 調試資料
        //dd($ingredients); // 確認資料是否包含 `id`
        
        return view('products.ingredients', compact('ingredients'));
    }

    public function update(Request $request)
    {
        $ingredients = $request->input('ingredients', []);
        
        foreach ($ingredients as $index => $ingredientData) {
            $ingredient = Ingredient::find($ingredientData['id']);
            if ($ingredient) {
                $ingredient->update([
                    'ingredient_name' => $ingredientData['ingredient_name'],
                    'price' => $ingredientData['price'],
                    'is_active' => isset($ingredientData['is_active']),
                ]);
            }
        }

        return redirect()->route('products.ingredients.index')
                         ->with('success', '配料已成功更新');
    }

    public function store(Request $request)
    {
        // 創建配料
        Ingredient::create([
            'ingredient_name' => $request->input('ingredient_name'),
            'price' => $request->input('price'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('products.ingredients.index')
                         ->with('success', '配料已成功新增');
    }
}

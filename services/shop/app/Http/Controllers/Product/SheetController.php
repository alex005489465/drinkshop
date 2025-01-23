<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Sheet;
use App\Events\Product\ProductCreated;

class SheetController extends Controller
{
    
    public function index()
    {
        $sheets = Sheet::all();
        return view('products.sheets', compact('sheets'));
    }

    public function store(Request $request)
    {
        // 提取所有數組資料
        $sheets = $request->input('sheets');

        foreach ($sheets as $sheetData) {
            // 檢查必須的欄位
            if (!isset($sheetData['product_name']) || empty($sheetData['product_name'])) {
                redirect()->route('products.sheets.list');
            }

            // 如果有 ID 且 ID 值不為 "create"，則執行更新，否則執行新增
            if (isset($sheetData['product_id']) && $sheetData['product_id'] != 'create') {
                $sheet = Sheet::find($sheetData['product_id']);
                if ($sheet) {
                    $sheet->update($sheetData);
                } else {
                    return response()->json(['error' => 'Product not found'], 404);
                }
            } else {
                $sheet = Sheet::create($sheetData);
                event(new ProductCreated($sheet));
            }
        }

        return redirect()->route('products.sheets.list'); 
    }
}

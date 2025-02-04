<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    /**
     * 購物車項目格式範例:
     * {
     *   "1": {                        // 項目索引作為key
     *     "product_id": 1,           // 商品ID
     *     "product_name": "珍珠奶茶", // 商品名稱
     *     "cup_size": 3,            // 杯型大小(1=S,2=M,3=L,4=XL)
     *     "base_price": 60,         // 飲料基礎價格
     *     "sugar": 3,               // 糖度(1=無糖,2=微糖,3=半糖,4=少糖,5=全糖)
     *     "ice": 3,                 // 冰塊(1=無冰,2=微冰,3=半冰,4=少冰,5=正常冰)
     *     "ingredients": [           // 加料
     *       {
     *         "id": 1,              // 配料ID
     *         "name": "珍珠",        // 配料名稱
     *         "price": 10,          // 配料單價
     *         "quantity": 1         // 配料數量
     *       }
     *     ],
     *     "price": 70,              // 單品總價(飲料+配料)
     *     "quantity": 2,            // 購買數量
     *     "subtotal": 140,          // 小計金額
     *     "note": "加熱"            // 備註(客製化需求)
     *   }
     * }
     */
    protected $fillable = [
        'user_id',        // 用戶ID
        'cart_items',     // 購物車項目(JSON格式)
        'total_amount'    // 總金額(小計金額總和)
    ];

    protected $casts = [
        'cart_items' => 'array',    // JSON自動轉換為陣列
        'total_amount' => 'integer' // 金額轉換為整數
    ];

    /**
     * 驗證購物車項目格式
     */
    public function isValidCartItems($cartItems): bool
    {
        if (!is_string($cartItems)) {
            return false;
        }

        $data = json_decode($cartItems, true);
        if (!is_array($data)) {
            return false;
        }

        foreach ($data as $index => $item) {
            if (!$this->isValidCartItem($item)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 驗證單一購物車項目
     */
    private function isValidCartItem($item): bool
    {
        $required = [
            'product_id', 'product_name', 'cup_size',
            'base_price', 'sugar', 'ice', 'ingredients',
            'price', 'quantity', 'subtotal', 'note'
        ];

        foreach ($required as $field) {
            if (!isset($item[$field])) {
                return false;
            }
        }

        // 驗證糖度、冰塊和杯型範圍
        if ($item['sugar'] < 1 || $item['sugar'] > 5 ||
            $item['ice'] < 1 || $item['ice'] > 5 ||
            $item['cup_size'] < 1 || $item['cup_size'] > 4) {
            return false;
        }

        // 驗證加料陣列格式
        foreach ($item['ingredients'] as $ingredient) {
            if (!isset($ingredient['id']) ||
                !isset($ingredient['name']) ||
                !isset($ingredient['price']) ||
                !isset($ingredient['quantity'])) {
                return false;
            }
        }

        return true;
    }
}
<?php

namespace App\Manage\Responses\Product;

use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;

/**
 * 啟用產品列表回應
 * 
 * @return JsonResponse
 * 
 * @response {
 *   "products": [
 *     {
 *       "product_id": "01JKJ3BB7BC628R6RFFT66X69V",
 *       "product_name": "藍莓果茶",
 *       "status": true
 *     },
 *     {
 *       "product_id": "01JKJ3BB7BC628R6RFFT66X70V",
 *       "product_name": "柳橙綠茶",
 *       "status": true
 *     }
 *   ],
 *   "pagination": {
 *     "current_page": 1,
 *     "per_page": 10,
 *     "total": 50,
 *     "total_pages": 5,
 *     "previous_page_url": null,
 *     "next_page_url": "http://example.com/api/products/enabled?page=2&per_page=10"
 *   }
 * }
 * 
 * @response ?page=2 {
 *   "products": [
 *     {
 *       "product_id": "01JKJ3BB7BC628R6RFFT66X71V",
 *       "product_name": "蜂蜜檸檬",
 *       "status": true
 *     }
 *   ],
 *   "pagination": {
 *     "current_page": 2,
 *     "per_page": 10,
 *     "total": 50,
 *     "total_pages": 5,
 *     "previous_page_url": "http://example.com/api/products/enabled?page=1&per_page=10",
 *     "next_page_url": "http://example.com/api/products/enabled?page=3&per_page=10"
 *   }
 * }
 */
class ProductListEnabledResponse extends ProductListResponse
{
    public function __invoke(): JsonResponse
    {
        $products = Product::where('status', true)
            ->paginate($this->perPage, ['*'], 'page', $this->page);
            
        $response = $this->formatResponse($products);
        return response()->json($response);
    }
}

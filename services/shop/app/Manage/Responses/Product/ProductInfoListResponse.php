<?php

namespace App\Manage\Responses\Product;

use App\Models\Product\Product;
use App\Models\Product\Description;
use App\Models\Product\Price;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;

/**
 * 產品信息列表回應
 * 
 * @return JsonResponse
 * 
 * @response {
 *   "products": [
 *     {
 *       "product_id": "01JKJ3BB7BC628R6RFFT66X69V",
 *       "product_name": "藍莓果茶",
 *       "price": 60,
 *       "description": "新鮮藍莓搭配特調果茶",
 *       "status": true,
 *       "created_at": "2024-01-20T12:00:00.000000Z",
 *       "updated_at": "2024-01-20T12:00:00.000000Z"
 *     }
 *   ],
 *   "pagination": {
 *     "current_page": 1,
 *     "per_page": 10,
 *     "total": 50,
 *     "total_pages": 5,
 *     "previous_page_url": null,
 *     "next_page_url": "http://example.com/api/products/info?page=2&per_page=10"
 *   }
 * }
 */
class ProductInfoListResponse
{
    private int $perPage;
    private int $page;

    public function __construct(int $perPage = 5, int $page = 1)
    {
        $this->perPage = $perPage;
        $this->page = $page;
    }

    private function buildPageUrl(?int $page): ?string
    {
        if ($page === null) {
            return null;
        }

        return URL::current() . '?' . http_build_query([
            'page' => $page,
            'per_page' => $this->perPage
        ]);
    }

    private function enrichProductData($products): array
    {
        $productIds = collect($products->items())->pluck('product_id');
        
        // 獲取描述信息
        $descriptions = Description::whereIn('product_id', $productIds)
            ->get()
            ->keyBy('product_id');
            
        // 獲取價格信息
        $prices = Price::whereIn('product_id', $productIds)
            ->get()
            ->keyBy('product_id');

        return array_map(function ($product) use ($descriptions, $prices) {
            $productId = $product['product_id'];
            return [
                'product_id' => $productId,
                'product_name' => $product['product_name'],
                'price' => $prices[$productId]->price ?? 0,
                'description' => $descriptions[$productId]->description ?? '',
                'status' => $product['status'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at']
            ];
        }, $products->items());
    }

    private function formatResponse($products): array
    {
        $currentPage = $products->currentPage();
        $lastPage = $products->lastPage();

        return [
            'products' => $this->enrichProductData($products),
            'pagination' => [
                'current_page' => $currentPage,
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'total_pages' => $lastPage,
                'previous_page_url' => $this->buildPageUrl($currentPage > 1 ? $currentPage - 1 : null),
                'next_page_url' => $this->buildPageUrl($currentPage < $lastPage ? $currentPage + 1 : null)
            ]
        ];
    }

    public function __invoke(): JsonResponse
    {
        $products = Product::where('status', true)
            ->orderBy('product_id')
            ->paginate($this->perPage, [
                'product_id',
                'product_name',
                'status',
                'created_at',
                'updated_at'
            ], 'page', $this->page);

        $response = $this->formatResponse($products);
        return response()->json($response);
    }
}

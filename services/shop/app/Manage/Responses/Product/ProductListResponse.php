<?php

namespace App\Manage\Responses\Product;

use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;

/**
 * 產品列表回應
 * 
 * @return JsonResponse
 * 
 * @response ?page=2&per_page=10 {
 *   "products": [
 *     {
 *       "product_id": "01JKJ3BB7BC628R6RFFT66X69V",
 *       "product_name": "藍莓果茶",
 *       "status": true
 *     }
 *   ],
 *   "pagination": {
 *     "current_page": 2,
 *     "per_page": 10,
 *     "total": 150,
 *     "total_pages": 15,
 *     "previous_page_url": "http://example.com/api/products?page=1&per_page=10",
 *     "next_page_url": "http://example.com/api/products?page=3&per_page=10"
 *   }
 * }
 */
class ProductListResponse
{
    protected int $perPage;
    protected int $page;

    public function __construct(int $perPage = 15, int $page = 1)
    {
        $this->perPage = $perPage;
        $this->page = $page;
    }

    protected function buildPageUrl(?int $page): ?string
    {
        if ($page === null) {
            return null;
        }

        return URL::current() . '?' . http_build_query([
            'page' => $page,
            'per_page' => $this->perPage
        ]);
    }

    protected function formatProducts(array $products): array
    {
        return array_map(function ($product) {
            return [
                'product_id' => $product['product_id'],
                'product_name' => $product['product_name'],
                'status' => $product['status']
            ];
        }, $products);
    }

    protected function formatResponse($products): array
    {
        $currentPage = $products->currentPage();
        $lastPage = $products->lastPage();

        return [
            'products' => $this->formatProducts($products->items()),
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
        $products = Product::paginate($this->perPage, ['*'], 'page', $this->page);
        $response = $this->formatResponse($products);
        return response()->json($response);
    }
}

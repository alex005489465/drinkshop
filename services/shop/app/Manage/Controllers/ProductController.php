<?php

namespace App\Manage\Controllers;

use App\Manage\Responses\Product\ProductListResponse;
use App\Manage\Responses\Product\ProductListEnabledResponse;
use App\Manage\Responses\Product\ProductInfoListResponse;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * 取得產品列表
     * 
     * @param Request $request
     * @return JsonResponse
     * @see ProductListResponse
     * 
     * @urlParam page integer 頁碼 (預設: 1). Example: 1
     * @urlParam per_page integer 每頁數量 (預設: 15). Example: 10
     * 
     * @request {
     *   "query": {
     *     "page": 2,
     *     "per_page": 10
     *   },
     *   "method": "GET",
     *   "url": "/api/products?page=2&per_page=10"
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);
        return (new ProductListResponse($perPage, $page))();
    }

    /**
     * 取得產品信息列表
     * 
     * @param Request $request
     * @return JsonResponse
     * @see ProductInfoListResponse
     * 
     * @urlParam page integer 頁碼 (預設: 1). Example: 1
     * @urlParam per_page integer 每頁數量 (預設: 5). Example: 10
     * 
     * @request {
     *   "query": {
     *     "page": 1,
     *     "per_page": 10
     *   },
     *   "method": "GET",
     *   "url": "/api/products/info?page=1&per_page=10"
     * }
     */
    public function listProducts(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);
        return (new ProductInfoListResponse($perPage, $page))();
    }

    /**
     * 建立新產品
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * @response 201 {
     *   "id": 1,
     *   "name": "珍珠奶茶",
     *   "price": 60,
     *   "description": "香濃奶茶搭配QQ珍珠",
     *   "created_at": "2024-01-20T12:00:00.000000Z",
     *   "updated_at": "2024-01-20T12:00:00.000000Z"
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * 取得單一產品
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * @response {
     *   "id": 1,
     *   "name": "珍珠奶茶",
     *   "price": 60,
     *   "description": "香濃奶茶搭配QQ珍珠",
     *   "created_at": "2024-01-20T12:00:00.000000Z",
     *   "updated_at": "2024-01-20T12:00:00.000000Z"
     * }
     */
    public function show(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->id);
        return response()->json($product);
    }

    /**
     * 更新產品
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * @response {
     *   "id": 1,
     *   "name": "珍珠奶茶",
     *   "price": 65,
     *   "description": "香濃奶茶搭配QQ珍珠",
     *   "created_at": "2024-01-20T12:00:00.000000Z",
     *   "updated_at": "2024-01-21T15:30:00.000000Z"
     * }
     */
    public function update(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->id);
        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * 刪除產品
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * @response 204 {}
     */
    public function destroy(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->id);
        $product->delete();
        return response()->json(null, 204);
    }
}

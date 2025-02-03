<?php

namespace App\Shop\Controllers;

use App\Shop\Controllers\Controller;
use App\Shop\Responses\Order\ProductListResponse;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        return new ProductListResponse();
    }
}
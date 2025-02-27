<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Jobs\GetRandomProductsJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class MainApiController extends Controller
{
    public function getRandomProducts()
    {
        $products = Cache::get('random_products', []);

        if (empty($products)) {
            dispatch(new GetRandomProductsJob());
        }

        return response()->json($products);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Jobs\GetRandomProductsJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class MainApiController extends Controller
{
    public function getRandomProducts()
    {
        $products = Product::select('id', 'название', 'цена', 'скидка')
            ->with(['основноеФото', 'среднийРейтинг'])
            ->inRandomOrder()
            ->take(10)
            ->get();

        return response()->json($products);
    }

    public function test()
    {
        $response = Http::get(route('api.random-products'));
        return $response->json();
    }
}

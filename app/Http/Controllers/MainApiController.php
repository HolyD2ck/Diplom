<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\AttributeValue;
use App\Models\Attribute;
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
    public function getDiscountProducts()
    {
        $products = Product::select('id', 'название', 'цена', 'скидка')
            ->where('скидка', '>', 80)
            ->orderBy('скидка', 'desc')
            ->with(['основноеФото', 'среднийРейтинг'])
            ->take(10)
            ->get();

        return response()->json($products);
    }
    public function getBestProducts()
    {
        $products = Product::select('товары.id', 'товары.название', 'товары.цена', 'товары.скидка')
            ->join('рейтинг_товаров', 'товары.id', '=', 'рейтинг_товаров.товар_id')
            ->where('рейтинг_товаров.средний_рейтинг', '>', 4.7)
            ->with(['основноеФото', 'среднийРейтинг'])
            ->orderBy('рейтинг_товаров.средний_рейтинг', 'desc')
            ->take(10)
            ->get();

        return response()->json($products);
    }
    public function getShopProducts($categoryId)
    {
        $products = Product::where('категория_id', $categoryId)
            ->with(['основноеФото', 'среднийРейтинг', 'фотографии', 'значенияАтрибутов'])
            ->paginate(6);

        $products->each(function ($product) {
            $product->makeHidden(['created_at', 'updated_at']);
            optional($product->основноеФото)->makeHidden(['created_at', 'updated_at']);
            optional($product->среднийРейтинг)->makeHidden(['created_at', 'updated_at']);

            if ($product->фотографии) {
                $product->фотографии->each(function ($фото) {
                    $фото->makeHidden(['created_at', 'updated_at']);
                });
            }

            if ($product->значенияАтрибутов) {
                $product->значенияАтрибутов->each(function ($значение) {
                    $значение->makeHidden(['created_at', 'updated_at']);
                });
            }
        });

        return response()->json($products);
    }
}

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function getShopProducts(Request $request, $categoryId)
    {
        $query = Product::where('категория_id', $categoryId)
            ->with(['основноеФото', 'среднийРейтинг', 'фотографии', 'значенияАтрибутов']);

        // Фильтр по цене с учетом скидки
        if ($request->has('filters.price_min') && $request->has('filters.price_max')) {
            $query->whereBetween(DB::raw('цена * (1 - скидка / 100)'), [
                $request->input('filters.price_min'),
                $request->input('filters.price_max')
            ]);
        } else {
            if ($request->has('filters.price_min')) {
                $query->whereRaw('цена * (1 - скидка / 100) >= ?', [$request->input('filters.price_min')]);
            }
            if ($request->has('filters.price_max')) {
                $query->whereRaw('цена * (1 - скидка / 100) <= ?', [$request->input('filters.price_max')]);
            }
        }

        // Фильтр по скидке
        if ($request->has('filters.discount_min')) {
            $query->where('скидка', '>=', $request->input('filters.discount_min'));
        }
        if ($request->has('filters.discount_max')) {
            $query->where('скидка', '<=', $request->input('filters.discount_max'));
        }

        // Фильтр по производителям (множественный выбор)
        if ($request->has('filters.manufacturers')) {
            $query->whereIn('производитель', $request->input('filters.manufacturers'));
        }

        // Сортировка
        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'price_asc':
                    $query->orderByRaw('цена * (1 - скидка / 100) ASC');
                    break;
                case 'price_desc':
                    $query->orderByRaw('цена * (1 - скидка / 100) DESC');
                    break;
                case 'rating_desc':
                    $query->withAvg('среднийРейтинг as средний_рейтинг', 'средний_рейтинг')->orderBy('средний_рейтинг', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('дата_поступления_в_продажу', 'desc');
                    break;
            }
        }

        $products = $query->paginate(6);
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
    public function getAllAboutProduct($id)
    {
        $product = Product::with([
            'среднийРейтинг',
            'фотографии',
            'значенияАтрибутов',
            'поставщик',
            'отзывы' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
        ])->find($id);

        if (!$product) {
            return response()->json(['error' => 'Товар не найден!'], 404);
        }

        optional($product->среднийРейтинг)->makeHidden(['created_at', 'updated_at']);
        optional($product->поставщик)->makeHidden(['created_at', 'updated_at']);

        optional($product->фотографии)->each(function ($фото) {
            $фото->makeHidden(['created_at', 'updated_at']);
        });

        optional($product->значенияАтрибутов)->each(function ($значение) {
            $значение->makeHidden(['created_at', 'updated_at']);
        });

        optional($product->отзывы)->each(function ($отзыв) {
            $отзыв->makeHidden('updated_at');
        });

        return response()->json($product);
    }
}

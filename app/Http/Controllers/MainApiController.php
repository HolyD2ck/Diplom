<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Models\Address;
use App\Models\Category;
use App\Models\Attribute;

class MainApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllInfoProduct()
    {
        $products = Product::with([
            'категория',
            'поставщик',
            'значенияАтрибутов.атрибут',
            'фотографии',
            'основноеФото',
            'среднийРейтинг',

        ])->get();

        return response()->json($products);
    }
    public function getReviewsForProduct($id)
    {
        $product = Product::where('id', $id)
            ->with('отзывы.пользователь')
            ->first();

        if (!$product) {
            return response()->json(['error' => 'Товар не найден'], 404);
        }

        return response()->json($product);
    }


    /**
     * Store a newly created resource in storage.
     */
}

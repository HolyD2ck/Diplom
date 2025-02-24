<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json(['cart' => $cart], 200);
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['error' => 'Товар не найден'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['количество'] += $request->quantity ?? 1;
        } else {
            $cart[$request->product_id] = [
                'товар_id' => $product->id,
                'название' => $product->название,
                'цена' => $product->цена,
                'скидка' => $product->скидка,
                'количество' => $request->quantity ?? 1,
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['success' => 'Товар добавлен в корзину', 'cart' => $cart], 200);
    }
}

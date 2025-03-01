<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function getCart()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', ['cart' => $cart]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['количество'] += $quantity;
        } else {
            $cart[$product->id] = [
                'товар_id' => $product->id,
                'название' => $product->название,
                'цена' => $product->цена,
                'скидка' => $product->скидка ?? 0,
                'количество' => $quantity,
                'фото' => $product->основноеФото->путь ?? 'images/default.jpg',
            ];
        }

        session()->put('cart', $cart);
        session()->save();

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Корзина очищена!');
    }


}
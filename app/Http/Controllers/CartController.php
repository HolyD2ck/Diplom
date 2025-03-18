<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
class CartController extends Controller
{
    public function getCart()
    {
        try {
            if (auth()->check()) {
                $cartItems = Cart::where('пользователь_id', auth()->id())->with('товар')->get();
                $cart = [];

                foreach ($cartItems as $item) {
                    if ($item->товар) {
                        $cart[$item->товар_id] = [
                            'товар_id' => $item->товар_id,
                            'название' => $item->товар->название,
                            'цена' => $item->товар->цена,
                            'скидка' => $item->товар->скидка ?? 0,
                            'количество' => $item->количество,
                            'фото' => $item->товар->основноеФото->путь ?? 'images/default.jpg',
                        ];
                    }
                }
            } else {
                $cart = session()->get('cart', []);
            }

            return view('shop.cart', ['cart' => $cart]);
        } catch (\Exception $e) {
            \Log::error('Ошибка загрузки корзины: ' . $e->getMessage());
            return back()->with('error', 'Ошибка загрузки корзины.');
        }
    }


    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        if (auth()->check()) {
            $cartItem = Cart::firstOrNew([
                'пользователь_id' => auth()->id(),
                'товар_id' => $product->id,
            ]);

            $cartItem->количество += $request->input('quantity', 1);
            $cartItem->save();
        } else {
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
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }
    public function clearCart()
    {
        if (auth()->check()) {
            Cart::where('пользователь_id', auth()->id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->back()->with('success', 'Корзина очищена!');
    }
}
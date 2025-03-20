<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ShopFavorite extends Component
{
    public $favorites = [];

    public function mount()
    {
        $this->loadFavorites();
    }

    public function loadFavorites()
    {
        if (Auth::check()) {
            $favoriteItems = Favorite::where('пользователь_id', Auth::id())->with('товар')->get();
            foreach ($favoriteItems as $item) {
                if ($item->товар) {
                    $this->favorites[$item->товар_id] = [
                        'товар_id' => $item->товар_id,
                        'название' => $item->товар->название,
                        'цена' => $item->товар->цена,
                        'скидка' => $item->товар->скидка ?? 0,
                        'фото' => $item->товар->основноеФото->путь ?? 'images/default.jpg',
                    ];
                }
            }
        } else {
            $favoriteIds = session()->get('favorites', []);
            $favoriteProducts = Product::whereIn('id', $favoriteIds)->get();
            foreach ($favoriteProducts as $product) {
                $this->favorites[$product->id] = [
                    'товар_id' => $product->id,
                    'название' => $product->название,
                    'цена' => $product->цена,
                    'скидка' => $product->скидка ?? 0,
                    'фото' => $product->основноеФото->путь ?? 'images/default.jpg',
                ];
            }
        }
    }

    public function removeFromFavorites($productId)
    {
        if (Auth::check()) {
            Favorite::where('пользователь_id', Auth::id())
                ->where('товар_id', $productId)
                ->delete();
        } else {
            $favorites = session()->get('favorites', []);
            if (($key = array_search($productId, $favorites)) !== false) {
                unset($favorites[$key]);
                session()->put('favorites', $favorites);
            }
        }
        unset($this->favorites[$productId]);
        $this->dispatch('favoriteUpdated');
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (Auth::check()) {
            $cartItem = Cart::firstOrNew([
                'пользователь_id' => Auth::id(),
                'товар_id' => $productId,
            ]);
            $cartItem->количество += 1;
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['количество'] += 1;
            } else {
                $cart[$productId] = [
                    'товар_id' => $productId,
                    'название' => $product->название,
                    'цена' => $product->цена,
                    'скидка' => $product->скидка ?? 0,
                    'количество' => 1,
                    'фото' => $product->основноеФото->путь ?? 'images/default.jpg',
                ];
            }
            session()->put('cart', $cart);
        }

        $this->removeFromFavorites($productId);

        $this->dispatch('cartUpdated');
        $this->dispatch('favoriteUpdated');
        session()->flash('success', 'Товар добавлен в корзину!');
    }

    public function render()
    {
        return view('livewire.shop-favorite');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;
use App\Models\Cart;

class ShopCart extends Component
{
    public array $cart = [];
    public $shops;
    public $user;
    public $selectedShopId = null;
    public $paymentMethod = '';
    public $isOpen = false;

    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function mount()
    {
        try {
            $this->user = Auth::user();
            $this->shops = Address::all();
            $this->refreshCart();
        } catch (\Exception $e) {
            \Log::error('Ошибка загрузки корзины: ' . $e->getMessage());
            $this->cart = [];
        }
    }

    public function refreshCart()
    {
        if (Auth::check()) {
            $this->cart = Cart::where('пользователь_id', Auth::id())
                ->with('товар')
                ->get()
                ->map(function ($item) {
                    return [
                        'товар_id' => $item->товар_id,
                        'название' => $item->товар->название,
                        'цена' => $item->товар->цена,
                        'скидка' => $item->товар->скидка ?? 0,
                        'количество' => $item->количество,
                        'фото' => $item->товар->основноеФото->путь ?? 'images/default.jpg',
                    ];
                })
                ->toArray();
        } else {
            $this->cart = session()->get('cart', []);
        }
    }

    public function updateQuantity($productId, $change)
    {
        if (Auth::check()) {
            $cartItem = Cart::where('пользователь_id', Auth::id())
                ->where('товар_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->количество = max(1, $cartItem->количество + $change);
                $cartItem->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['количество'] = max(1, $cart[$productId]['количество'] + $change);
                session()->put('cart', $cart);
            }
        }

        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }

    public function removeFromCart($productId)
    {
        if (Auth::check()) {
            Cart::where('пользователь_id', Auth::id())
                ->where('товар_id', $productId)
                ->delete();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
        }

        $this->refreshCart();
        $this->dispatch('cartUpdated');
    }

    public function openReviewModal()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Вы должны войти в аккаунт, чтобы заказать товар!');
            return;
        }

        $this->isOpen = true;
    }

    public function closeReviewModal()
    {
        $this->isOpen = false;
    }

    public function saveOrder()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Корзина пуста.');
            return;
        }

        if (!$this->selectedShopId) {
            session()->flash('error', 'Выберите адрес доставки.');
            return;
        }

        try {
            DB::transaction(function () {
                $order = Order::create([
                    'пользователь_id' => Auth::id(),
                    'адрес_доставки_id' => $this->selectedShopId,
                    'итоговая_цена' => collect($this->cart)->sum(fn($item) => $item['цена'] * $item['количество']),
                ]);

                foreach ($this->cart as $item) {
                    OrderDetail::create([
                        'заказ_id' => $order->id,
                        'товар_id' => $item['товар_id'] ?? null,
                        'количество' => $item['количество'] ?? 1,
                        'цена' => $item['цена'] ?? 0,
                    ]);
                }
                Cart::where('пользователь_id', Auth::id())->delete();
                session()->forget('cart');
                $this->cart = [];
            });

            session()->flash('success', 'Заказ успешно оформлен!');
            $this->dispatch('orderAdded');
            $this->closeReviewModal();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            session()->flash('error', 'Произошла ошибка при создании заказа: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.shop-cart', [
            'cart' => $this->cart,
            'shops' => $this->shops,
            'user' => $this->user,
        ]);
    }
}

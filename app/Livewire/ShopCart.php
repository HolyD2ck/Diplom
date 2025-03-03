<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Schema\Expect;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Address;

class ShopCart extends Component
{
    public $cart = [];
    public $shops;
    public $user;
    public $selectedShopId = null;
    public $paymentMethod = '';
    public $isOpen = false;
    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->shops = Address::all();
        $this->user = Auth::user();
    }

    public function updateQuantity($productId, $change)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['количество'] = max(1, $cart[$productId]['количество'] + $change);
            session()->put('cart', $cart);
        }

        $this->cart = $cart;
        $this->dispatch(['cartUpdated']);
    }

    public function refreshCart()
    {
        $this->cart = session()->get('cart', []);
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        $this->cart = $cart;
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
            });

            $this->cart = [];
            session()->put('cart', []);
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
<?php

namespace App\Livewire;

use Livewire\Component;

class ShopCart extends Component
{
    public $cart = [];
    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function updateQuantity($productId, $change)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['количество'] = max(1, $cart[$productId]['количество'] + $change);
            session()->put('cart', $cart);
        }

        $this->cart = $cart;
        $this->dispatch('cartUpdated');
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

    public function render()
    {
        return view('livewire.shop-cart', [
            'cart' => $this->cart,
        ]);
    }
}
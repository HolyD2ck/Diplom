<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Navigation extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }
    public function updateCartCount()
    {
        $cart = session()->get('cart', []);
        $this->cartCount = collect($cart)->sum('количество');
    }
    public function logout(): void
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
        $this->redirect(route('dashboard', absolute: false), navigate: false);
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}

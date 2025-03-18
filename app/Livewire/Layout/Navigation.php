<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
class Navigation extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount', 'orderAdded' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }
    public function updateCartCount()
    {
        if (auth()->check()) {
            $this->cartCount = Cart::where('пользователь_id', auth()->id())->sum('количество');
        } else {
            $cart = session()->get('cart', []);
            $this->cartCount = collect($cart)->sum('количество');
        }
    }

    public function logout(): void
    {
        \Log::info('Logout method called');
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

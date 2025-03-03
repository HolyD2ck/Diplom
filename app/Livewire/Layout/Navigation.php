<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
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
        $cart = session()->get('cart', []);
        if (!empty($cart)) {
            $this->cartCount = collect($cart)->sum('количество');
        } else {
            $this->cartCount = 0;
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

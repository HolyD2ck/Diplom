<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Favorite;
class Navigation extends Component
{
    public $cartCount = 0;
    public $favoriteCount = 0;

    protected $listeners = [
        'cartUpdated' => 'updateCartCount',
        'orderAdded' => 'updateCartCount',
        'favoriteUpdated' => 'updateFavoriteCount',
        'newPhoto' => 'updatePhoto',
    ];

    public function mount()
    {
        $this->updateCartCount();
        $this->updateFavoriteCount();
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
    public function updateFavoriteCount()
    {
        if (Auth::check()) {
            $this->favoriteCount = Favorite::where('пользователь_id', Auth::id())->count();
        } else {
            $favorites = session()->get('favorites', []);
            $this->favoriteCount = count($favorites);
        }
    }
    public function updatePhoto()
    {
        $this->dispatch('');
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

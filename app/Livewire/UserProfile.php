<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class UserProfile extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::where('пользователь_id', Auth::id())
            ->with(['деталиЗаказа.товар.основноеФото'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }
    public function render()
    {
        return view('livewire.user-profile', [
            'orders' => $this->orders,
        ]);
    }
}

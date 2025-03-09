<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteReviews;
use Illuminate\Support\Facades\Log;

class ShopContacts extends Component
{
    public $имя_клиента, $отзыв, $email;

    public function createReview()
    {
        $this->validate([
            'имя_клиента' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'отзыв' => 'required|string',
        ]);

        SiteReviews::create([
            'имя_клиента' => $this->имя_клиента,
            'отзыв' => $this->отзыв,
            'email' => $this->email,
        ]);
        $this->reset('имя_клиента', 'отзыв', 'email');
        return redirect()->route('contacts');
    }

    public function render()
    {
        return view('livewire.shop-contacts');
    }
}
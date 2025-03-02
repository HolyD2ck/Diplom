<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteReviews;

class ShopContacts extends Component
{
    public $reviews;
    public $имя_клиента, $отзыв, $email;

    public function mount()
    {
        $this->reviews = SiteReviews::latest()->take(10)->get();
    }

    public function createReview()
    {
        $review = SiteReviews::create([
            'имя_клиента' => $this->имя_клиента,
            'отзыв' => $this->отзыв,
            'email' => $this->email,
        ]);

        $this->reviews->prepend($review);
        $this->reviews->save();
        $this->reset('имя_клиента', 'отзыв', 'email');
    }

    public function render()
    {
        return view('livewire.shop-contacts', [
            'reviews' => $this->reviews,
        ])->with('key', time());
    }

}




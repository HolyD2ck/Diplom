<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteReviews;

class ShowReviews extends Component
{
    public $reviews;
    public $loading = false;


    public function mount()
    {
        $this->loadReviews();
    }

    public function loadReviews()
    {
        $this->reviews = SiteReviews::latest()->take(10)->get();
    }

    public function render()
    {
        return view('livewire.show-reviews', ['reviews' => $this->reviews]);
    }
}
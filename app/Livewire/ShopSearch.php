<?php

namespace App\Livewire;

use Livewire\Component;

class ShopSearch extends Component
{
    public $search = '';
    public $searchResults = [];

    public function search()
    {
        \Log::info('Search updated:', ['search' => $this->search]);

    }

    public function render()
    {
        return view(
            'livewire.shop-search'
        );
    }
}

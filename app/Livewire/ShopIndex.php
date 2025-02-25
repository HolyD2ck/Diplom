<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ShopIndex extends Component
{
    public $search = '';
    public $selectedCategory = null;
    public $categories;

    public function mount()
    {

        $this->categories = Category::all();
    }

    public function render()
    {

        return view('livewire.shop-index', [
            'categories' => $this->categories,
        ]);
    }
}

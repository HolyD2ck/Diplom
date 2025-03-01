<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class ShopProducts extends Component
{
    public $categoryId;
    public $category = null;
    public $products = [];

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->category = Category::find($categoryId);
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $response = Http::get('http://127.0.0.1:8000/shop-products/' . $this->categoryId);
        $this->products = $response->successful() ? $response->json() : [];
    }

    public function render()
    {
        return view('livewire.shop-products', [
            'category' => $this->category,
            'products' => $this->products,
        ]);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopIndex extends Component
{
    public $selectedCategory = null;
    public $categories;
    public $popularProducts = [];
    public $discountProducts = [];
    public $bestProducts = [];


    public function mount()
    {
        $this->categories = \Cache::remember('categories', 3600, function () {
            return Category::all();
        });
        $this->loadPopularProducts();
        $this->loadBestProducts();
        $this->loadDiscountProducts();
    }
    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
        ];
    }
    public function loadPopularProducts()
    {
        $response = Http::get('http://halava7d.beget.tech/random-products');
        $this->popularProducts = $response->successful() ? $response->json() : [];
    }

    public function loadDiscountProducts()
    {
        $response = Http::get('http://halava7d.beget.tech/discount-products');
        $this->discountProducts = $response->successful() ? $response->json() : [];
    }

    public function loadBestProducts()
    {
        $response = Http::get('http://halava7d.beget.tech/best-products');
        $this->bestProducts = $response->successful() ? $response->json() : [];
    }

    public function render()
    {
        return view('livewire.shop-index', [
            'categories' => $this->categories,
            'popularProducts' => $this->popularProducts,
            'discountProducts' => $this->discountProducts,
            'bestProducts' => $this->bestProducts,
        ]);
    }
}
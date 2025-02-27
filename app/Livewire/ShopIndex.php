<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class ShopIndex extends Component
{
    public $search = '';
    public $selectedCategory = null;
    public $categories;
    public $popularProducts = [];

    public function mount()
    {
        $this->categories = \Cache::remember('categories', 3600, function () {
            return Category::all();
        });
        $this->loadPopularProducts();
    }

    public function loadPopularProducts()
    {
        try {
            $response = Http::timeout(10)->get(route('api.random-products'));
            $this->popularProducts = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $this->popularProducts = [];
            \Log::error('Failed to load popular products from API: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.shop-index', [
            'categories' => $this->categories,
            'popularProducts' => $this->popularProducts,
        ]);
    }
}
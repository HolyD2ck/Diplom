<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopProducts extends Component
{
    public $categoryId;
    public $category = null;
    public $products = [];
    public $currentPage = 1;
    public $filters = [
        'manufacturers' => [],
        'price_min' => 0,
        'price_max' => 9999999,
        'discount_min' => 0,
        'discount_max' => 100,
    ];
    public $manufacturers = [];
    public $sortBy = 'default';

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->category = Category::find($categoryId);

        if (!$this->category) {
            $this->products = [];
            return;
        }

        $this->manufacturers = Product::select('производитель')
            ->where('категория_id', $categoryId)
            ->distinct()
            ->pluck('производитель')
            ->toArray();

        $this->loadProducts();
    }

    public function loadProducts()
    {
        $query = [
            'page' => $this->currentPage,
            'filters' => $this->filters,
            'sort' => $this->sortBy,
        ];

        $fullUrl = "http://halavaay.beget.tech/shop-products/{$this->categoryId}?" . http_build_query($query);

        $response = Http::timeout(15)->get($fullUrl);
        $this->products = $response->json();

        Log::info('Продукты Загружены:');

        $this->dispatch('refresh');
    }

    public function applyFilters()
    {
        $this->currentPage = 1;
        $this->loadProducts();
    }

    public function updateSort($sort)
    {
        $this->sortBy = $sort;
        $this->currentPage = 1;
        $this->loadProducts();
    }

    public function goToPage($page)
    {
        $this->currentPage = $page;
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.shop-products', [
            'category' => $this->category,
            'products' => $this->products,
            'manufacturers' => $this->manufacturers,
            'filters' => $this->filters,
            'sortBy' => $this->sortBy,
            'currentPage' => $this->currentPage,
        ]);
    }
}

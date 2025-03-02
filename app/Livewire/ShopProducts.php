<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ShopProducts extends Component
{
    public $categoryId;
    public $category = null;
    public $products = [];
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

    public function loadProducts($url = null)
    {

        if ($url) {
            $fullUrl = $url;
        } else {
            $query = [];

            if (!empty($this->filters)) {
                $query['filters'] = $this->filters;
            }

            if ($this->sortBy !== 'default') {
                $query['sort'] = $this->sortBy;
            }


            $fullUrl = "http://halava7d.beget.tech/shop-products/{$this->categoryId}?" . http_build_query($query);
        }

        $response = Http::timeout(15)->get($fullUrl);
        $this->products = $response->json();

        $this->dispatch('refresh');
    }


    public function applyFilters()
    {
        $this->loadProducts();
    }

    public function updateSort($sort)
    {
        $this->sortBy = $sort;
        $this->loadProducts();
    }

    public function goToPage($url)
    {
        $this->loadProducts($url);
    }

    public function render()
    {
        return view('livewire.shop-products', [
            'category' => $this->category,
            'products' => $this->products,
            'manufacturers' => $this->manufacturers,
        ]);
    }
}

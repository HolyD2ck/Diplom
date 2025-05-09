<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Attribute;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class ShopProducts extends Component
{
    protected $listeners = ['favoriteUpdated' => '$refresh'];
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
        'attributes' => [],
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

        if (isset($this->products['data'])) {
            foreach ($this->products['data'] as &$product) {
                $product['is_favorite'] = $this->checkFavoriteStatus($product['id']);
            }
        }

        Log::info('Продукты Загружены:');

    }

    protected function checkFavoriteStatus($productId)
    {
        if (Auth::check()) {
            return Favorite::where('пользователь_id', Auth::id())
                ->where('товар_id', $productId)
                ->exists();
        }

        $favorites = session()->get('favorites', []);
        return in_array($productId, $favorites);
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

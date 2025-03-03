<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ShopSearch extends Component
{
    public $value = '';
    public $searchResults = [];

    public function FindDelo()
    {
        Log::info('Updated value: ' . $this->value);
        $this->searchResults = [];

        if (!empty($this->value)) {
            $products = Product::where('название', 'like', '%' . $this->value . '%')
                ->limit(5)
                ->get(['id', 'название']);

            $categories = Category::where('название', 'like', '%' . $this->value . '%')
                ->limit(5)
                ->get(['id', 'название']);

            $this->searchResults = [
                'products' => $products,
                'categories' => $categories
            ];
        }
    }


    public function render()
    {
        return view('livewire.shop-search', [
            'searchResults' => $this->searchResults,
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Nette\Schema\Expect;
use App\Models\Product;

class ShopShow extends Component
{
    public $productId;
    public $product = [];
    public $similarProducts = [];
    public $visibleReviews = 5;
    public $isOpen = false;
    public $rating = 5;
    public $mainPhoto;
    public $reviewText = '';

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadProduct();
        $this->similarProducts();
    }

    public function loadProduct()
    {
        try {
            $response = Http::timeout(15)->get("http://halavaay.beget.tech/product/{$this->productId}");
            $this->product = $response->successful() ? $response->json() : [];

            $this->mainPhoto = collect($this->product['фотографии'] ?? [])
                ->where('основное', true)
                ->pluck('путь')
                ->first() ?? ($this->product['фотографии'][0]['путь'] ?? 'images/default.jpg');

        } catch (\Exception $e) {
            $this->product = [];
            \Log::error('Failed to load product ' . $this->productId . ': ' . $e->getMessage());
        }
    }
    public function similarProducts()
    {
        $product = Product::find($this->productId);
        $this->similarProducts = Product::where('категория_id', $product->категория_id)
            ->with('основноеФото', 'среднийРейтинг')
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(10)
            ->get()
            ->toArray();
    }
    public function setMainPhoto($photoPath)
    {
        $this->mainPhoto = $photoPath;
    }
    public function loadMoreReviews()
    {
        $this->visibleReviews += 10;
    }

    public function openReviewModal()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Вы должны войти в аккаунт, чтобы оставить отзыв!');
            return;
        }

        $this->isOpen = true;
    }

    public function closeReviewModal()
    {
        $this->isOpen = false;
        $this->reset(['rating', 'reviewText']);
    }
    public function saveReview()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Вы должны войти в аккаунт, чтобы оставить отзыв!');
            return;
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviewText' => 'required|string|min:5',
        ]);

        Review::create([
            'пользователь_id' => Auth::id(),
            'товар_id' => $this->productId,
            'рейтинг' => $this->rating,
            'отзыв' => $this->reviewText,
        ]);

        $this->loadProduct();
        $this->dispatch('reviewAdded')->to('shop-show');
        $this->closeReviewModal();
    }

    public function render()
    {
        return view('livewire.shop-show', [
            'product' => $this->product,
            'visibleReviews' => $this->visibleReviews,
            'mainPhoto' => $this->mainPhoto,
            'similarProducts' => $this->similarProducts,
        ]);
    }
}

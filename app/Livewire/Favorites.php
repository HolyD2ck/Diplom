<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class Favorites extends Component
{
    public $productId;
    public $isFavorite = false;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->checkIfFavorite();
    }

    public function checkIfFavorite()
    {
        if (Auth::check()) {
            $this->isFavorite = Favorite::where('пользователь_id', Auth::id())
                ->where('товар_id', $this->productId)
                ->exists();
        } else {
            $favorites = session()->get('favorites', []);
            $this->isFavorite = in_array($this->productId, $favorites);
        }
    }

    public function toggleFavorite()
    {
        if (!Auth::check()) {
            $favorites = session()->get('favorites', []);

            if (in_array($this->productId, $favorites)) {
                $favorites = array_diff($favorites, [$this->productId]);
                $this->isFavorite = false;
            } else {
                $favorites[] = $this->productId;
                $this->isFavorite = true;
            }

            session()->put('favorites', array_values($favorites));
        } else {
            if ($this->isFavorite) {
                Favorite::where('пользователь_id', Auth::id())
                    ->where('товар_id', $this->productId)
                    ->delete();
                $this->isFavorite = false;
            } else {
                Favorite::create([
                    'пользователь_id' => Auth::id(),
                    'товар_id' => $this->productId,
                ]);
                $this->isFavorite = true;
            }
        }
        $this->dispatch('favoriteUpdated');
    }

    public function render()
    {
        return view('livewire.favorites');
    }
}
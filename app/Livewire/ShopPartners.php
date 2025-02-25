<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
class ShopPartners extends Component
{
    public function mount()
    {

        $this->suppliers = Supplier::all();
    }
    public function render()
    {
        return view('livewire.shop-partners', [
            'suppliers' => $this->suppliers,
        ]);
    }
}

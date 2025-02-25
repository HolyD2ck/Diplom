<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class ShopWorkers extends Component
{
    public $employees;

    public function mount()
    {
        $this->employees = Employee::all();
    }

    public function render()
    {
        return view('livewire.shop-workers', [
            'employees' => $this->employees,
        ]);
    }
}
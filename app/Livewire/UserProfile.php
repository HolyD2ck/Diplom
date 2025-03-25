<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserProfile extends Component
{
    use WithFileUploads;

    public $orders;
    public $newPhoto;
    public $newPhotoPreview;

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Order::where('пользователь_id', Auth::id())
            ->with(['деталиЗаказа.товар.основноеФото'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    public function updatedNewPhoto()
    {
        if ($this->newPhoto) {
            $this->newPhotoPreview = $this->newPhoto->temporaryUrl();
        }
    }

    public function updatePhoto()
    {
        $this->validate([
            'newPhoto' => 'required|image|max:4096',
        ]);

        $user = Auth::user();
        $userFolder = 'img/users/' . str_replace(' ', '_', strtolower($user->name));

        if ($user->photo && Storage::exists($user->photo)) {
            Storage::delete($user->photo);
        }

        $fileName = 'user_' . $user->id . '_' . time() . '.' . $this->newPhoto->getClientOriginalExtension();
        $path = $this->newPhoto->storeAs($userFolder, $fileName, 'public');

        $user->update(['photo' => $path]);

        $this->reset('newPhoto', 'newPhotoPreview');

        session()->flash('message', 'Фото успешно обновлено!');
    }

    public function render()
    {
        return view('livewire.user-profile', [
            'orders' => $this->orders,
        ]);
    }
}

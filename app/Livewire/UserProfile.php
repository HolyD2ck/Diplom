<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

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
        \Log::info('Начало обновления фото для пользователя: ' . Auth::id());

        $this->validate([
            'newPhoto' => 'required|image|max:4096',
        ]);

        $user = Auth::user();
        $userFolder = 'img/users/' . str_replace(' ', '_', strtolower($user->name));

        if (!file_exists(public_path($userFolder))) {
            mkdir(public_path($userFolder), 0777, true);
            \Log::info("Создана папка: " . public_path($userFolder));
        }

        $fileName = 'user_' . $user->id . '_' . time() . '.' . $this->newPhoto->getClientOriginalExtension();
        $dbPath = $userFolder . '/' . $fileName;
        $fullPath = public_path($dbPath);

        try {
            $this->newPhoto->storeAs($userFolder, $fileName, 'public_uploads');
            \Log::info("Фото успешно загружено: {$dbPath}");


            DB::table('users')
                ->where('id', $user->id)
                ->update(['фото' => $dbPath]);

            \Log::info("База данных обновлена: новое фото = " . $dbPath);

            $this->newPhotoPreview = asset($dbPath);
            $this->reset('newPhoto');

            session()->flash('message', 'Фото успешно обновлено!');
            $this->dispatch('newPhoto');
        } catch (\Exception $e) {
            \Log::error("Ошибка при загрузке фото: " . $e->getMessage());
            session()->flash('error', 'Ошибка при загрузке фото.');
        }
    }


    public function render()
    {
        return view('livewire.user-profile', [
            'orders' => $this->orders,
        ]);
    }
}

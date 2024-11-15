<?php

namespace App\Filament\Admin\Resources\OrderDetailResource\Pages;

use App\Filament\Admin\Resources\OrderDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderDetail extends CreateRecord
{
    protected static string $resource = OrderDetailResource::class;
}

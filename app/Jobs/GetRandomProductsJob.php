<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class GetRandomProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public function handle()
    {
        try {
            $products = Product::select('id', 'название', 'цена', 'скидка')
                ->with(['основноеФото', 'среднийРейтинг'])
                ->inRandomOrder()
                ->take(10)
                ->get();

            Cache::put('random_products', $products, 60);

            Log::info('Кэш случайных товаров обновлён.');
        } catch (\Exception $e) {
            Log::error('Ошибка при обновлении случайных товаров: ' . $e->getMessage());
        }
    }
}

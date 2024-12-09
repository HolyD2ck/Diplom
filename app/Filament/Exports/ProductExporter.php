<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use SimpleXMLElement;
use Symfony\Component\Yaml\Yaml;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('категория_id'),
            ExportColumn::make('название'),
            ExportColumn::make('описание'),
            ExportColumn::make('производитель'),
            ExportColumn::make('цена'),
            ExportColumn::make('дата_выпуска'),
            ExportColumn::make('дата_поступления_в_продажу'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and ' . number_format($export->successful_rows) . ' rows exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' rows failed to export.';
        }

        Log::info('Export details: ', [
            'processed_rows' => $export->processed_rows,
            'successful_rows' => $export->successful_rows,
            'failed_rows' => $export->getFailedRowsCount(),
        ]);

        return $body;
    }
}
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

    public static function exportToTxt(): BinaryFileResponse
    {
        $products = Product::limit(2)->get();
        $fileName = 'products_export.txt';
        $content = '';
    
        foreach ($products as $product) {
            $content .= implode(";", [
                $product->категория_id,
                $product->название,
                $product->описание,
                $product->производитель,
                $product->цена,
                $product->дата_выпуска,
                $product->дата_поступления_в_продажу,
            ]) . "\n";
        }
        $tempFilePath = storage_path('app/' . $fileName);
        file_put_contents($tempFilePath, $content);
        return Response::download($tempFilePath, $fileName, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public static function exportToXml(): BinaryFileResponse
    {
        $products = Product::skip(2)->take(2)->get();

        $xml = new SimpleXMLElement('<products/>');

        foreach ($products as $product) {
            $productElement = $xml->addChild('product');
            $productElement->addChild('категория_id', $product->категория_id);
            $productElement->addChild('название', $product->название);
            $productElement->addChild('описание', $product->описание);
            $productElement->addChild('производитель', $product->производитель);
            $productElement->addChild('цена', $product->цена);
            $productElement->addChild('дата_выпуска', $product->дата_выпуска);
            $productElement->addChild('дата_поступления_в_продажу', $product->дата_поступления_в_продажу);
        }

        $fileName = 'products_export.xml';
        $tempFilePath = storage_path('app/' . $fileName);
        $xml->asXML($tempFilePath);

        return Response::download($tempFilePath, $fileName, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
    public static function exportToYaml(): BinaryFileResponse
    {

        $products = Product::skip(4)->take(2)->get();

    $productArray = $products->map(function ($product) {
        return [
            'категория_id' => $product->категория_id,
            'название' => $product->название,
            'описание' => $product->описание,
            'производитель' => $product->производитель,
            'цена' => $product->цена,
            'дата_выпуска' => $product->дата_выпуска,
            'дата_поступления_в_продажу' => $product->дата_поступления_в_продажу,
        ];
    })->toArray();


    $yamlContent = Yaml::dump($productArray, 2, 2);

    $fileName = 'products_export.yaml';
    $tempFilePath = storage_path('app/' . $fileName);
    file_put_contents($tempFilePath, $yamlContent);

    return Response::download($tempFilePath, $fileName, [
        'Content-Type' => 'application/x-yaml',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ]);
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

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

    public static function import()
    {
        $xml = simplexml_load_file(storage_path('app/products_export.xml'));
        foreach ($xml->product as $importproduct) 
        {
            $product = new Product();
            $product->Название = $importproduct->название;
            $product->Описание = $importproduct->описание;
            $product->Производитель = $importproduct->производитель;
            $product->Цена = $importproduct->цена;
            $product->Дата_выпуска = $importproduct->дата_выпуска;
            $product->Дата_поступления_в_продажу = $importproduct->дата_поступления_в_продажу;
            $product->save();
        }
        $yaml = file_get_contents(storage_path('app/products_export.yaml'));
        $products = Yaml::parse($yaml);
        foreach ($products as $importproduct) 
        {
            $product = new Product();
            $product->Название = $importproduct['название'];
            $product->Описание = $importproduct['описание'];
            $product->Производитель = $importproduct['производитель'];
            $product->Цена = $importproduct['цена'];
            $product->Дата_выпуска = Carbon::createFromTimestamp($importproduct['дата_выпуска'])->format('Y-m-d H:i:s');
            $product->Дата_поступления_в_продажу = Carbon::createFromTimestamp($importproduct['дата_поступления_в_продажу'])->format('Y-m-d H:i:s');
            $product->save();
        }
    
        $basePath = storage_path('app/private/filament_exports');
        $directories = File::directories($basePath);  
        usort($directories, function($a, $b) {
            return basename($a) <=> basename($b);
        });
        $latestDirectory = end($directories);
        $csvFile = $latestDirectory . '/0000000000000001.csv';
        if (file_exists($csvFile)) {
            $csv = Reader::createFromPath($csvFile, 'r');
            $csv->setDelimiter(',');
            $rows = $csv->getIterator();
        
            foreach ($rows as $row) {
                $product = new Product();
                $product->Название = $row[2];
                $product->Описание = $row[3];
                $product->Производитель = $row[4];
                $product->Цена = $row[5];
                $product->Дата_выпуска = $row[6];
                $product->Дата_поступления_в_продажу = $row[7];
                $product->save();
            }
        }

        $txt = file_get_contents(storage_path('app/products_export.txt'));
        $products = explode("\n", $txt);
        
        foreach ($products as $importproduct) {
            $importproductData = explode(";", $importproduct);

            if (count($importproductData) < 7) {
                continue; 
            }
            $product = new Product();
            $product->Название = $importproductData[1];
            $product->Описание = $importproductData[2];
            $product->Производитель = $importproductData[3];
            $product->Цена = $importproductData[4];
            $product->Дата_выпуска = $importproductData[5] ;
            $product->Дата_поступления_в_продажу = $importproductData[6];
            $product->save();
        }         
    }
}

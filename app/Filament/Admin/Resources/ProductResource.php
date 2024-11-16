<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Tables\Actions\ExportAction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;    
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('категория_id')
                    ->numeric(),
                Forms\Components\TextInput::make('название')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('описание')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('производитель')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('цена')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('дата_выпуска')
                    ->required(),
                Forms\Components\DatePicker::make('дата_поступления_в_продажу')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('категория_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('производитель')
                    ->searchable(),
                Tables\Columns\TextColumn::make('цена')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('дата_выпуска')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('дата_поступления_в_продажу')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exporter(\App\Filament\Exports\ProductExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ExportBulkAction::make()
                ->exporter(\App\Filament\Exports\ProductExporter::class)
                ]),
                
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

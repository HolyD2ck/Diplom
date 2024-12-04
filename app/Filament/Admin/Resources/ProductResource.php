<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Filament\Forms\Components\{Select, CheckboxList, TextInput, Textarea, FileUpload, Toggle, Repeater, DatePicker};
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('категория_id')
                    ->label('Категория')
                    ->options(Category::all()->pluck('название', 'id'))
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(fn($state, $set) => $set('атрибуты', [])),
                Repeater::make('атрибуты')
                    ->label('Атрибуты')
                    ->maxItems(1)
                    ->schema(function ($get) {
                        $categoryId = $get('категория_id');
                        $attributes = Category::find($categoryId)?->attributes;
                        return $attributes?->map(function ($attribute) {
                            return TextInput::make("атрибут_{$attribute->id}")
                                ->label($attribute->название)
                                ->required();
                        })->toArray() ?? [];
                    })
                    ->columns(3),
                TextInput::make('название')
                    ->maxLength(100),
                Textarea::make('описание')
                    ->columnSpanFull(),
                TextInput::make('производитель')
                    ->maxLength(100),
                TextInput::make('цена')
                    ->numeric(),
                DatePicker::make('дата_выпуска'),
                DatePicker::make('дата_поступления_в_продажу'),
                FileUpload::make('фотографии')
                    ->label('Фотографии')
                    ->multiple()
                    ->image()
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
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

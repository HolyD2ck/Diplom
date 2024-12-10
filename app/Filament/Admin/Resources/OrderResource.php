<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Filament\Admin\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('пользователь_id')
                    ->label('Пользователь')
                    ->relationship('пользователь', 'name')
                    ->required(),

                Forms\Components\Repeater::make('деталиЗаказа')
                    ->label('Детали заказа')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('товар_id')
                            ->label('Товар')
                            ->relationship('товар', 'название')
                            ->required(),
                        Forms\Components\TextInput::make('количество')
                            ->label('Количество')
                            ->required()
                            ->numeric()
                            ->minValue(1),
                    ])
                    ->createItemButtonLabel('Добавить товар')
                    ->required(),

                Forms\Components\Select::make('статус')
                    ->options([
                        'Оплачено' => 'Оплачено',
                        'В обработке' => 'В обработке',
                        'Доставлено' => 'Доставлено',
                        'Отменено' => 'Отменено',
                    ])
                    ->default('В обработке'),
                Forms\Components\Select::make('адрес_доставки_id')
                    ->label('Адрес доставки')
                    ->relationship('адрес', 'город')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('пользователь_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('итоговая_цена')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('статус'),
                Tables\Columns\TextColumn::make('адрес_доставки_id')
                    ->numeric()
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
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

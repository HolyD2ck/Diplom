<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SupplierResource\Pages;
use App\Filament\Admin\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('название_компании')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('контактное_лицо')
                    ->maxLength(255),
                Forms\Components\TextInput::make('телефон')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('электронная_почта')
                    ->maxLength(255),
                Forms\Components\TextInput::make('вебсайт')
                    ->maxLength(255),
                Forms\Components\TextInput::make('банковский_счет')
                    ->maxLength(255),
                Forms\Components\TextInput::make('инн')
                    ->maxLength(20),
                Forms\Components\DatePicker::make('дата_начала_сотрудничества'),
                Forms\Components\DatePicker::make('дата_окончания_сотрудничества'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('название_компании')
                    ->searchable(),
                Tables\Columns\TextColumn::make('контактное_лицо')
                    ->searchable(),
                Tables\Columns\TextColumn::make('телефон')
                    ->searchable(),
                Tables\Columns\TextColumn::make('электронная_почта')
                    ->searchable(),
                Tables\Columns\TextColumn::make('вебсайт')
                    ->searchable(),
                Tables\Columns\TextColumn::make('банковский_счет')
                    ->searchable(),
                Tables\Columns\TextColumn::make('инн')
                    ->searchable(),
                Tables\Columns\TextColumn::make('дата_начала_сотрудничества')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('дата_окончания_сотрудничества')
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}

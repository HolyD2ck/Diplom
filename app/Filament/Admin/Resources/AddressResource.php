<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AddressResource\Pages;
use App\Filament\Admin\Resources\AddressResource\RelationManagers;
use App\Models\Address;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('улица')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('город')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('область')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('почтовый_индекс')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('страна')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('улица')
                    ->searchable(),
                Tables\Columns\TextColumn::make('город')
                    ->searchable(),
                Tables\Columns\TextColumn::make('область')
                    ->searchable(),
                Tables\Columns\TextColumn::make('почтовый_индекс')
                    ->searchable(),
                Tables\Columns\TextColumn::make('страна')
                    ->searchable(),
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}

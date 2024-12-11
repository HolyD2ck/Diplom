<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Filament\Admin\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('фамилия')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('должность')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('электронная_почта')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('телефон')
                    ->required()
                    ->maxLength(50),
                Forms\Components\DatePicker::make('дата_рождения')
                    ->required(),
                Forms\Components\DatePicker::make('дата_найма')
                    ->required(),
                Forms\Components\TextInput::make('зарплата')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('адрес')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('фамилия')
                    ->searchable(),
                Tables\Columns\TextColumn::make('должность')
                    ->searchable(),
                Tables\Columns\TextColumn::make('электронная_почта')
                    ->searchable(),
                Tables\Columns\TextColumn::make('телефон')
                    ->searchable(),
                Tables\Columns\TextColumn::make('дата_рождения')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('дата_найма')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('зарплата')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('адрес')
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}

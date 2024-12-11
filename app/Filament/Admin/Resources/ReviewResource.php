<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReviewResource\Pages;
use App\Filament\Admin\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('товар_id')
                    ->label('Товар')
                    ->relationship('товар', 'название')
                    ->required(),
                Forms\Components\Select::make('пользователь_id')
                    ->label('Пользователь')
                    ->relationship('пользователь', 'name')
                    ->required(),
                Forms\Components\Textarea::make('отзыв')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('рейтинг')
                    ->numeric()
                    ->default(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('товар.название')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('пользователь.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('рейтинг')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('отзыв')
                    ->label('Отзыв')
                    ->limit(20)
                    ->tooltip(fn($record) => $record->отзыв),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}

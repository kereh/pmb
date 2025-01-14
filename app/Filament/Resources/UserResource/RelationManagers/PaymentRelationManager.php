<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentRelationManager extends RelationManager
{
    protected static string $relationship = 'payment';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order_id')
                    ->searchable()
                    ->label('Order ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('snap_token')
                    ->searchable()
                    ->label('Snap Token')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('users.nama')
                    ->searchable()
                    ->label('Nama Calon'),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->searchable()
                    ->label('Biaya'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return match ($record->status) {
                            0 => 'Belum Lunas',
                            1 => 'Lunas',
                        };
                    })
                    ->color(function ($record) {
                        return match ($record->status) {
                            0 => 'danger',
                            1 => 'success',
                        };
                    })
                    ->label('Status Pembayaran'),
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

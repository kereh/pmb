<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentRelationManager extends RelationManager
{
    protected static string $relationship = 'payment';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->label('Status Pembayaran')
                    ->required()
                    ->options([
                        0 => 'Belum Lunas',
                        1 => 'Lunas',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_id')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('order_id')
                    ->searchable()
                    ->label('Order ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('snap_token')
                    ->searchable()
                    ->label('Snap Token')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('users.nama')
                    ->searchable()
                    ->label('Nama Calon'),
                TextColumn::make('waktu_pembayaran')
                    ->dateTime('d F Y, H:i:s')
                    ->label('Waktu Pembayaran'),
                TextColumn::make('jenis_pembayaran')
                    ->label('Jenis Pembayaran')
                    ->searchable(),
                TextColumn::make('bank')
                    ->label('BANK')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('IDR')
                    ->searchable()
                    ->label('Biaya'),
                TextColumn::make('status')
                    ->label('Status Pembayaran')
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
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
}

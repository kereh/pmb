<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use App\Filament\Resources\PaymentsResource\Pages;
use App\Filament\Resources\PaymentsResource\RelationManagers;

use App\Models\Payments;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentsResource extends Resource
{
    protected static ?string $model = Payments::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->required()
                    ->maxLength(36),
                TextInput::make('order_id')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->required()
                    ->maxLength(255),
                Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label('Waktu Pembayaran')
                    ->dateTime()
                    ->searchable(),
                TextColumn::make('jenis_pembayaran')
                    ->label('Jenis Pembayaran')
                    ->searchable(),
                TextColumn::make('bank')
                    ->label('BANK')
                    ->searchable()
                    ->getStateUsing(fn ($record) => strtoupper($record->bank)),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayments::route('/create'),
            'edit' => Pages\EditPayments::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}

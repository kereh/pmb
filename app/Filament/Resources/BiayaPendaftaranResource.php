<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BiayaPendaftaranResource\Pages;
use App\Filament\Resources\BiayaPendaftaranResource\RelationManagers;
use App\Models\BiayaPendaftaran;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BiayaPendaftaranResource extends Resource
{
    protected static ?string $model = BiayaPendaftaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?string $navigationLabel = 'Biaya Pendaftaran';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $pluralLabel = 'Biaya Pendaftaran';
    protected static ?string $slug = 'biaya-pendaftaran';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('biaya')->numeric()->step(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('biaya')->money('IDR'),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
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
            'index' => Pages\ListBiayaPendaftarans::route('/'),
            'create' => Pages\CreateBiayaPendaftaran::route('/create'),
            'edit' => Pages\EditBiayaPendaftaran::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool {
        return false;
    }
}

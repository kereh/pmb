<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataResource\Pages;
use App\Filament\Resources\DataResource\RelationManagers;
use App\Models\Data;

use Filament\Facades\Filament;
use Filament\Resources\Resource;

use Filament\Forms;
use Filament\Forms\Form;

use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataResource extends Resource
{
    protected static ?string $model = Data::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationLabel = 'Data Calon Mahasiswa';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('pas_foto')
                    ->label('Pas Foto')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('nama')
                    ->label('Nama'),
                TextColumn::make('users.email')
                    ->label('Email'),
                TextColumn::make('nomor_hp')
                    ->label('Nomor HP'),
                TextColumn::make('program_studi.nama')
                    ->label('Program Studi'),
                TextColumn::make('users.payment.status')
                    ->label('Status Pembayaran')
                    ->getStateUsing(fn ($record) => $record->users->payment->status == 0 ? 'Belum Lunas' : 'Lunas')
                    ->badge()
                    ->colors([
                        'success' => 'Lunas',
                        'danger' => 'Belum Lunas'
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListData::route('/'),
            'create' => Pages\CreateData::route('/create'),
            'edit' => Pages\EditData::route('/{record}/edit'),
        ];
    }
}

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
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $pluralLabel = 'Data';
    protected static ?int $navigationSort = 1;

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
                TextColumn::make('alamat')
                    ->label('Alamat'),
                TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir'),
                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->dateTime('d F Y'),
                TextColumn::make('agama')
                    ->label('Agama'),
                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return match ($record->jenis_kelamin) {
                            'L' => 'Laki-laki',
                            'P' => 'Perempuan',
                        };
                    }),
                
                TextColumn::make('program_studi.nama')
                    ->label('Program Studi'),
                TextColumn::make('users.payment.status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return match ($record->users->payment->status) {
                            0 => 'Belum Lunas',
                            1 => 'Lunas',
                        };
                    })
                    ->color(function ($record) {
                        return match ($record->users->payment->status) {
                            0 => 'danger',
                            1 => 'success',
                        };
                    }),
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

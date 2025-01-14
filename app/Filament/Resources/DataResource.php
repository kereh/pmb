<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataResource\Pages;
use App\Filament\Resources\DataResource\RelationManagers;
use App\Models\Data;

use Filament\Facades\Filament;
use Filament\Resources\Resource;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Grouping\Group;
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
                TextInput::make('nama'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('program_studi.nama')
                    ->label('Program Studi'),
                Group::make('users.seleksi.status')
                    ->label('Status Penerimaan'),
                Group::make('users.payment.status')
                    ->getTitleFromRecordUsing(fn (object $record): string => match($record->users->payment->status) {
                        0 => 'Belum Lunas',
                        1 => 'Lunas',
                    })
                    ->label('Status Pembayaran'),
            ])
            ->columns([
                ImageColumn::make('pas_foto')
                    ->label('Pas Foto')
                    ->disk('public')
                    ->alignCenter()
                    ->circular()
                    ->toggleable()
                    ->sortable(),
                IconColumn::make('ijazah_atau_skl')
                    ->label('Ijazah/SKL')
                    ->url(fn ($record) => $record->ijazah_atau_skl, shouldOpenInNewTab: true)
                    ->color('success')
                    ->icon('heroicon-o-document-text')
                    ->tooltip('Lihat Ijazah/SKL')
                    ->alignCenter()
                    ->toggleable(),
                IconColumn::make('kip')
                    ->label('KIP')
                    ->getStateUsing(fn ($record) => $record->kip ? 'Available' : 'Not Available')
                    ->url(fn ($record) => $record->kip, shouldOpenInNewTab: true)
                    ->color(fn ($record) => $record->kip ? 'success' : 'danger')
                    ->icon(fn ($record) => $record->kip ? 'heroicon-o-document-text' : 'heroicon-o-x-mark')
                    ->tooltip(fn ($record) => $record->kip ? 'Lihat Kartu KIP' : 'Kartu KIP Kosong')
                    ->alignCenter()
                    ->toggleable(),
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('users.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('nomor_hp')
                    ->label('Nomor HP')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('kewarganegaraan')
                    ->label('Kewarganegaraan')
                    ->toggleable(),
                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->dateTime('d F Y')
                    ->toggleable(),
                TextColumn::make('agama')
                    ->label('Agama')
                    ->toggleable(),
                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->getStateUsing(fn (object $record): string => $record->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan')
                    ->toggleable(),
                TextColumn::make('pendidikan_terakhir')
                    ->label('Pendidikan Terakhir')
                    ->toggleable(),
                TextColumn::make('program_studi.nama')
                    ->label('Program Studi')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('users.payment.status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->getStateUsing(fn (object $record): string => match($record->users->payment->status) {
                        0 => 'Belum Lunas',
                        1 => 'Lunas',
                    })
                    ->color(fn (object $record): string => match($record->users->payment->status) {
                        0 => 'danger',
                        1 => 'success',
                    })
                    ->toggleable(),
                TextColumn::make('users.seleksi.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (object $record): string => match($record->users->seleksi->status) {
                        'Tahap Seleksi' => 'primary',
                        'Tidak Lulus' => 'danger',
                        'Lulus' => 'success',
                    })
                    ->toggleable(),
            ])
            ->filters([
                //
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

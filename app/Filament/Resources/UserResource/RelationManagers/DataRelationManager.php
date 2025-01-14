<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;

use Filament\Forms;
use Filament\Forms\Form;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataRelationManager extends RelationManager
{
    protected static string $relationship = 'data';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
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

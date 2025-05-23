<?php

namespace App\Filament\Resources\DataResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->minLength(3)
                    ->string()
                    ->required()
                    ->validationMessages([
                        'min:3' => ':attribute minimal 3 karakter',
                        'string' => ':attribute tidak boleh berisi angka!',
                        'required' => ':attribute tidak boleh kosong!',
                    ]),
                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->validationMessages([
                        'email' => ':attribute email tidak valid',
                        'unique' => ':attribute sudah digunakan!',
                        'required' => ':attribute tidak boleh kosong!'
                    ]),
                TextInput::make('username')
                    ->minLength(4)
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->validationMessages([
                        'min:4' => ':attribute minimal 3 karakter',
                        'unique' => ':attribute sudah digunakan!',
                        'required' => ':attribute tidak boleh kosong!'
                    ]),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->minLength(4)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($livewire) => ($livewire instanceof CreateRecord))
                    ->validationMessages([
                        'min:4' => ':attribute minimal 4 karakter!',
                        'required' => ':attribute tidak boleh kosong!'
                    ]),
                Select::make('role_id')
                    ->relationship('roles', 'role')
                    ->label('Role')
                    ->required()
                    ->validationMessages([
                        'required' => ':attribute tidak boleh kosong!'
                    ]),
                Select::make('seleksi_id')
                    ->relationship('seleksi', 'status')
                    ->label('Seleksi Status')
            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->heading('Calon Mahasiswa')
            ->description('Tabel Relasi Calon Mahasiswa')
            ->columns([
                TextColumn::make('id')
                    ->label('ID Pengguna')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama')
                    ->label('Nama Pengguna')
                    ->toggleable(),
                TextColumn::make('email')
                    ->label('Email Pengguna')
                    ->toggleable(),
                TextColumn::make('username')
                    ->label('Username')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Mendaftar Pada')
                    ->toggleable()
                    ->dateTime('d F Y'),
                TextColumn::make('seleksi.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (object $record): string => match($record->seleksi->status) {
                        'Tahap Seleksi' => 'warning',
                        'Tidak Lulus' => 'danger',
                        'Lulus' => 'success',
                    })
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('seleksi')
                        ->label('Tahap Seleksi')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->action(function ($record) {
                            $record->seleksi_id = 1;
                            $record->save();

                            Notification::make()
                                ->title('Berhasil')
                                ->body('Status Seleksi Berhasil Diubah!')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\Action::make('lulus')
                        ->label('Lulus')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function ($record) {
                            $record->seleksi_id = 3;
                            $record->save();

                            Notification::make()
                                ->title('Berhasil')
                                ->body('Status Seleksi Berhasil Diubah!')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\Action::make('tidak_lulus')
                        ->label('Tidak Lulus')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->action(function ($record) {
                            $record->seleksi_id = 2;
                            $record->save();

                            Notification::make()
                                ->title('Berhasil')
                                ->body('Status Seleksi Berhasil Diubah!')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ], position: ActionsPosition::BeforeColumns);
    }
}
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
            ->recordTitleAttribute('user_id')
            ->columns([
                TextColumn::make('id')
                    ->label('ID Pengguna')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->label('Email Pengguna')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Mendaftar Pada')
                    ->sortable()
                    ->toggleable()
                    ->dateTime('d F Y'),
                TextColumn::make('seleksi.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (object $record): string => match($record->seleksi->status) {
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

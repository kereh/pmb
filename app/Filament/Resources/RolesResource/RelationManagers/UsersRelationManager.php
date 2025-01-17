<?php

namespace App\Filament\Resources\RolesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;

use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;

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
                        'string' => ':attribute tidak boleh berisi angka!',
                        'required' => ':attribute tidak boleh kosong!'
                    ]),
                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->validationMessages([
                        'unique' => ':attribute sudah digunakan!',
                        'required' => ':attribute tidak boleh kosong!'
                    ]),
                TextInput::make('username')
                    ->minLength(4)
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->validationMessages([
                        'unique' => ':attribute sudah digunakan!',
                        'required' => ':attribute tidak boleh kosong!'
                    ]),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->minLength(4)
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('seleksi')
                        ->label('Tahap Seleksi')
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
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
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('seleksi')
                        ->label('Tahap Seleksi')
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
                        ->action(function ($records) {
                            $records->each->update(['seleksi_id' => 1]);
                            Notification::make()
                                ->title('Berhasil')
                                ->body('Status Seleksi Berhasil Diubah!')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\BulkAction::make('lulus')
                        ->label('Lulus')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['seleksi_id' => 3]);
                            Notification::make()
                                ->title('Berhasil')
                                ->body('Status Seleksi Berhasil Diubah!')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\BulkAction::make('tidak_lulus')
                        ->label('Tidak Lulus')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each->update(['seleksi_id' => 2]);
                            Notification::make()
                                ->title('Berhasil')
                                ->body('Status Seleksi Berhasil Diubah!')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(UserExporter::class),
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ]);
    }
}

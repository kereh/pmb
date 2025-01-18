<?php

namespace App\Filament\Resources;

use App\Filament\Exports\UserExporter;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class UserResource extends Resource {
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
        ->groups([
                Group::make('seleksi.status')
                    ->label('Status Penerimaan'),
            ])
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
                        'Tahap Seleksi' => 'warning',
                        'Tidak Lulus' => 'danger',
                        'Lulus' => 'success',
                    })
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
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
            ])
            ->modifyQueryUsing(fn (Builder $query) 
                => $query->where('role_id', 2)->latest())
            ->defaultSort('created_at');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DataRelationManager::class,
            RelationManagers\PaymentRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

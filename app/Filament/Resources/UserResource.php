<?php

namespace App\Filament\Resources;

use App\Filament\Exports\UserExporter;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;

use App\Models\User;

use Filament\Resources\Resource;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                Group::make('created_at')
                    ->label('Tahun Pembuatan Akun')
                    ->date()
                    ->groupQueryUsing(fn (Builder $query) 
                        => $query->whereBetween('created_at', [
                                now()->subYear()->startOfYear(), 
                                now()->endOfYear(),
                            ]
                        )),
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
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(UserExporter::class),
                ])
            ])
            ->modifyQueryUsing(fn (Builder $query) 
                => $query->where('role_id', 2))
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

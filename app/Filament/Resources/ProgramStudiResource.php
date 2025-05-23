<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramStudiResource\Pages;
use App\Filament\Resources\ProgramStudiResource\RelationManagers\DataRelationManager;
use App\Models\ProgramStudi;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramStudiResource extends Resource
{
    protected static ?string $model = ProgramStudi::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Program Studi';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $pluralLabel = 'Program Studi';
    protected static ?string $slug = 'program-studi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Program Studi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('data_count')
                    ->counts('data')
                    ->label('Jumlah Pendaftar')
                    ->sortable(),
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
            DataRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgramStudis::route('/'),
            'create' => Pages\CreateProgramStudi::route('/create'),
            'edit' => Pages\EditProgramStudi::route('/{record}/edit'),
        ];
    }
}

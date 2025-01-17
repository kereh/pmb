<?php

namespace App\Filament\Resources;

use App\Filament\Exports\DataExporter;
use App\Filament\Resources\DataResource\Pages;
use App\Filament\Resources\DataResource\RelationManagers\UsersRelationManager;
use App\Models\Data;

use Filament\Facades\Filament;
use Filament\Resources\Resource;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DataResource extends Resource
{
    protected static ?string $model = Data::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationLabel = 'Data Calon Mahasiswa';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $pluralLabel = 'Data';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dokumen Calon')
                    ->description('Form Dokumen, pas foto, ijazah atau skl, dan kip')
                    ->schema([
                        FileUpload::make('pas_foto')
                            ->label('Pas Foto')
                            ->disk('public')
                            ->directory('pas_foto')
                            ->maxSize(1024)
                            ->image()
                            ->previewable()
                            ->imageEditor()
                            ->deletable()
                            ->rules(['mimes:png'])
                            ->getUploadedFileNameForStorageUsing(fn ($record) => $record->users->id . '.png')
                            ->deleteUploadedFileUsing(fn ($file) => Storage::disk('public')->delete($file)),
                        FileUpload::make('ijazah_atau_skl')
                            ->label('Ijazah/SKL')
                            ->disk('public')
                            ->directory('ijazah')
                            ->previewable()
                            ->maxSize(1024)
                            ->acceptedFileTypes(['application/pdf'])
                            ->getUploadedFileNameForStorageUsing(fn ($record) => $record->users->id . '.pdf')
                            ->deleteUploadedFileUsing(fn ($file) => Storage::disk('public')->delete($file)),
                        FileUpload::make('kip')
                            ->label('KIP')
                            ->disk('public')
                            ->directory('kip')
                            ->previewable()
                            ->maxSize(1024)
                            ->acceptedFileTypes(['application/pdf'])
                            ->getUploadedFileNameForStorageUsing(fn ($record) => $record->users->id . '.pdf')
                            ->deleteUploadedFileUsing(fn ($file) => Storage::disk('public')->delete($file)),
                    ])->columns(3),

                Section::make('Data Calon')
                    ->description('Data Diri & Program Studi Pilihan')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Calon')
                            ->minLength(3)
                            ->string()
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong',
                                'string' => ':attribute harus berbentuk huruf',
                                'min:3' => ':attribute minimal 3 karakter',
                            ]),
                        TextInput::make('nik')
                            ->label('NIK')
                            ->rules(['digits:16'])
                            ->numeric()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong',
                                'digits:16' => ':attribute harus 16 digit angka',
                                'numeric' => ':attribute harus berbentuk angka',
                                'unique:data' => ':attribute sudah digunakan',
                            ]),
                        TextInput::make('nisn')
                            ->label('NISN')
                            ->rules(['digits:10'])
                            ->numeric()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong',
                                'digits:10' => ':attribute harus 10 digit angka',
                                'numeric' => ':attribute harus berbentuk angka',
                                'unique:data' => ':attribute sudah digunakan',
                            ]),
                        TextInput::make('nama_ibu_kandung')
                            ->label('Ibu Kandung')
                            ->string()
                            ->required()
                            ->maxLength(50)
                            ->validationMessages([
                                'string' => ':attribute harus berbentuk huruf',
                                'required' => ':attribute tidak boleh kosong',
                                'max:50' => ':attribute tidak boleh lebih dari 50 karakter',
                            ]),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                        Textarea::make('alamat')
                            ->label('Alamat')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                        TextInput::make('nomor_hp')
                            ->label('Nomor HP')
                            ->required()
                            ->numeric()
                            ->minLength(10)
                            ->maxLength(13)
                            ->unique(ignoreRecord: true)
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong',
                                'numeric' => ':attribute harus berbentuk angka',
                                'min:10' => ':attribute minimal 10 karakter',
                                'max:13' => ':attribute maxksimal 13 karakter',
                                'unique:data' => ':attribute sudah digunakan',
                            ]),
                        Select::make('jenis_kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->label('Jenis Kelamin')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                        Select::make('pendidikan_terakhir')
                            ->options([
                                'SMA' => 'Sekolah Menengah Atas (SMA)',
                                'SMK' => 'Sekolah Menengah Kejuruan (SMK)',
                                'MA' => 'Madrasah Aliyah (MA)',
                                'MAK' => 'Madrasah Aliyah Kejuruan (MAK)',
                            ])
                            ->label('Pendidikan Terakhir')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                        Select::make('agama')
                            ->options([
                                'Kristen Protestan' => 'Kristen Protestan',
                                'Kristen Katolik' => 'Kristen Katolik',
                                'Islam' => 'Islam',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                            ])
                            ->label('Agama')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                        Select::make('kewarganegaraan')
                            ->options([
                                'WNI' => 'Warga Negara Indonesia',
                                'WNA' => 'Warga Negara Asing',
                            ])
                            ->label('Kewarganegaraan')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                        Select::make('program_studi_id')
                            ->label('Program Studi')
                            ->relationship('program_studi', 'nama')
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong'
                            ]),
                    ])->columns(3),

            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('users.created_at')
                    ->label('Tahun Pembuatan Akun')
                    ->groupQueryUsing(fn (Builder $query) 
                        => $query->whereBetween('users.created_at', [
                                now()->subYear()->startOfYear(), 
                                now()->endOfYear(),
                            ]
                        ))
                    ->date(),
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
                    ->toggleable()
                    ->sortable()
                    ->alignCenter()
                    ->extraImgAttributes(['class' => 'rounded-lg w-[300px] h-[400px]']),
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->toggleable()
                    ->copyable()
                    ->copyMessage('NIK Berhasil Disalin')
                    ->tooltip('Click Untuk Menyalin NIK')
                    ->sortable(),
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable()
                    ->toggleable()
                    ->copyable()
                    ->copyMessage('NISN Berhasil Disalin')
                    ->tooltip('Click Untuk Menyalin NISN')
                    ->sortable(),
                TextColumn::make('nama_ibu_kandung')
                    ->label('Ibu Kandung')
                    ->searchable()
                    ->toggleable()
                    ->copyable()
                    ->copyMessage('Nama Berhasil Disalin')
                    ->tooltip('Click Untuk Menyalin Nama')
                    ->sortable(),
                IconColumn::make('ijazah_atau_skl')
                    ->label('Ijazah/SKL')
                    ->url(fn ($record) => asset($record->ijazah_atau_skl), shouldOpenInNewTab: true)
                    ->color('success')
                    ->icon('heroicon-o-document-text')
                    ->tooltip('Click Untuk Melihat Ijazah/SKL')
                    ->alignCenter()
                    ->toggleable(),
                // TextColumn::make('kip'),
                IconColumn::make('kip')
                    ->label('KIP')
                    ->getStateUsing(fn ($record) => $record->kip ? 'Available' : 'Not Available')
                    ->url(fn ($record) => asset($record->kip), shouldOpenInNewTab: true)
                    ->color(fn ($record) => $record->kip ? 'success' : 'danger')
                    ->icon(fn ($record) => $record->kip ? 'heroicon-o-document-text' : 'heroicon-o-x-mark')
                    ->tooltip(fn ($record) => $record->kip ? 'Click Untuk Melihat Kartu KIP' : 'Kartu KIP Kosong')
                    ->alignCenter()
                    ->toggleable(),
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
                TextColumn::make('users.payments.status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->getStateUsing(fn (object $record): string => match($record->users->payments->status) {
                        0 => 'Belum Lunas',
                        1 => 'Lunas',
                    })
                    ->color(fn (object $record): string => match($record->users->payments->status) {
                        0 => 'danger',
                        1 => 'success',
                    })
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->after(function ($record) {
                            if ($record->pas_foto) Storage::disk('public')->delete($record->pas_foto);
                            if ($record->ijazah) Storage::disk('public')->delete($record->ijazah);
                            if ($record->kip) Storage::disk('public')->delete($record->kip);
                        }),
                ])->icon('heroicon-m-ellipsis-horizontal'),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(DataExporter::class),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListData::route('/'),
            'create' => Pages\CreateData::route('/create'),
            'edit' => Pages\EditData::route('/{record}/edit'),
            'view' => Pages\ViewData::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}

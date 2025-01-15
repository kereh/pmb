<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Exports\DataExporter;
use Filament\Resources\RelationManagers\RelationManager;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataRelationManager extends RelationManager
{
    protected static string $relationship = 'data';

    public function form(Form $form): Form
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
                            ->rules(['mimes:png'])
                            ->getUploadedFileNameForStorageUsing(fn ($record) => $record->users->id . '.png'),
                        FileUpload::make('ijazah_atau_skl')
                            ->label('Ijazah/SKL')
                            ->disk('public')
                            ->directory('ijazah')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['application/pdf'])
                            ->getUploadedFileNameForStorageUsing(fn ($record) => $record->users->id . '.pdf'),
                        FileUpload::make('kip')
                            ->label('KIP')
                            ->disk('public')
                            ->directory('kip')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['application/pdf'])
                            ->getUploadedFileNameForStorageUsing(fn ($record) => $record->users->id . '.pdf'),
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
                    ->size(55)
                    ->toggleable()
                    ->sortable(),
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
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
}

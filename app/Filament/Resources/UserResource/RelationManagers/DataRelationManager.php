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

use Illuminate\Support\Facades\Storage;

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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->heading('')
            ->columnToggleFormMaxHeight('350px')
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
                TextColumn::make('program_studi.nama')
                    ->label('Program Studi')
                    ->listWithLineBreaks()
                    ->badge()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('users.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('no_telp_pribadi')
                    ->label('Nomor Telp')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('no_telp_orang_tua')
                    ->label('Nomor Telp Orang Tua')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('asal_daerah_provinsi')
                    ->label('Daerah Propinsi')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('asal_daerah_kabupaten_kota')
                    ->label('Daerah Kabupaten/Kota')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('asal_sekolah')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('jurusan')
                    ->label('Jurusan Sebelumnya')
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
                TextColumn::make('rekomendasi')
                    ->label('Rekomendasi')
                    ->getStateUsing(fn ($record) => $record->rekomendasi ?? '-')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                IconColumn::make('ijazah')
                    ->label('Ijazah')
                    ->url(fn ($record) => asset($record->ijazah), shouldOpenInNewTab: true)
                    ->color('success')
                    ->icon('heroicon-m-document-text')
                    ->tooltip('Click Untuk Melihat Ijazah')
                    ->alignCenter()
                    ->toggleable(),
                IconColumn::make('kip')
                    ->label('KIP')
                    ->getStateUsing(fn ($record) => $record->kip ? 'Available' : 'Not Available')
                    ->url(fn ($record) => asset($record->kip), shouldOpenInNewTab: true)
                    ->color(fn ($record) => $record->kip ? 'success' : 'danger')
                    ->icon(fn ($record) => $record->kip ? 'heroicon-m-document-text' : 'heroicon-m-x-mark')
                    ->tooltip(fn ($record) => $record->kip ? 'Click Untuk Melihat Kartu KIP' : 'Kartu KIP Kosong')
                    ->alignCenter()
                    ->toggleable(),
                IconColumn::make('ktp')
                    ->label('KTP/Akte Kelahiran')
                    ->getStateUsing(fn ($record) => $record->ktp ? 'Available' : 'Not Available')
                    ->url(fn ($record) => asset($record->ktp), shouldOpenInNewTab: true)
                    ->color(fn ($record) => $record->ktp ? 'success' : 'danger')
                    ->icon(fn ($record) => $record->ktp ? 'heroicon-m-document-text' : 'heroicon-m-x-mark')
                    ->tooltip(fn ($record) => $record->ktp ? 'Click Untuk Melihat KTP/Akte kelahiran' : 'KTP/Akte kelahiran Kosong')
                    ->alignCenter()
                    ->toggleable(),
                IconColumn::make('kk')
                    ->label('Kartu Keluarga')
                    ->getStateUsing(fn ($record) => $record->kk ? 'Available' : 'Not Available')
                    ->url(fn ($record) => asset($record->kk), shouldOpenInNewTab: true)
                    ->color(fn ($record) => $record->kk ? 'success' : 'danger')
                    ->icon(fn ($record) => $record->kk ? 'heroicon-m-document-text' : 'heroicon-m-x-mark')
                    ->tooltip(fn ($record) => $record->kk ? 'Click Untuk Melihat Kartu Keluarga' : 'Kartu Keluarga Kosong')
                    ->alignCenter()
                    ->toggleable(),
                TextColumn::make('users.payments.status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->alignCenter()
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
                            if ($record->ktp) Storage::disk('public')->delete($record->ktp);
                            if ($record->kk) Storage::disk('public')->delete($record->kk);
                        }),
                ])->icon('heroicon-m-ellipsis-horizontal'),
            ], position: ActionsPosition::BeforeColumns);
    }
}

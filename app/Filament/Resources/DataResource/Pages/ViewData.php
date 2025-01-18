<?php

namespace App\Filament\Resources\DataResource\Pages;

use App\Filament\Resources\DataResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Fieldset;
use Filament\Resources\Pages\ViewRecord;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;

use Illuminate\Contracts\Support\Htmlable;

class ViewData extends ViewRecord
{
    protected static string $resource = DataResource::class;
    protected static string $view = 'filament.resources.data.pages.view-data';

    public function getTitle(): string | Htmlable
    {
        /** @var Post */
        $record = $this->getRecord();

        return $record->nama;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Info Calon Mahasiswa')
                    ->description('Berikut adalah info calon mahasiswa')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    ImageEntry::make('pas_foto')
                                        ->hiddenLabel()
                                        ->extraImgAttributes(['class' => 'self-center rounded-lg h-[400px] w-[300px]']),
                                ])
                                    ->columnSpan(['sm' => 0])
                                    ->extraAttributes(['class' => 'flex justify-center items-center h-full']),
                                Group::make([
                                    TextEntry::make('program_studi.nama')
                                        ->label('Program Studi Pilihan')
                                        ->icon('heroicon-o-academic-cap')
                                        ->badge()
                                        ->color('info'),
                                    TextEntry::make('users.created_at')
                                        ->label('Mendaftar Pada')
                                        ->dateTime('d F Y')
                                        ->icon('heroicon-o-user-plus')
                                        ->badge()
                                        ->color('gray'),
                                    TextEntry::make('users.seleksi.status')
                                        ->label('Status Penerimaan')
                                        ->color(fn ($record) => match($record->users->seleksi_id) {
                                            1 => 'warning',
                                            2 => 'danger',
                                            3 => 'success',
                                        })
                                        ->badge(),
                                    TextEntry::make('ijazah_atau_skl')
                                        ->label('Ijazah/SKL')
                                        ->badge()
                                        ->color('success')
                                        ->icon('heroicon-m-document-text')
                                        ->getStateUsing(fn ($record) => $record->ijazah_atau_skl ? 'Lihat Ijazah/SKL' : '')
                                        ->url(fn ($record) => asset($record->ijazah_atau_skl), shouldOpenInNewTab: true),
                                    TextEntry::make('kip')
                                        ->label('Kartu KIP')
                                        ->badge()
                                        ->color(fn ($record) => $record->kip ? 'success' : 'danger')
                                        ->icon('heroicon-m-document-text')
                                        ->getStateUsing(fn ($record) => $record->kip ? 'Lihat Kartu KIP' : 'Kartu KIP Tidak Tersedia')
                                        ->url(fn ($record) => $record->kip ? asset($record->kip) : '', shouldOpenInNewTab: true),
                                    TextEntry::make('users.payments.status')
                                        ->label('Status Pembayaran')
                                        ->getStateUsing(fn ($record) => $record->users->payments->status ? 'Lunas' : 'Belum Lunas')
                                        ->color(fn ($record) => match ($record->users->payments->status) {
                                            0 => 'danger',
                                            1 => 'success',
                                        })
                                        ->badge(),
                                ])
                                    ->columns(3)
                                    ->columnSpan(['sm' => 0, 'md' => 2]),
                        ]),
                    ])->collapsible(),

                Section::make()
                    ->description('Info Tambahan')
                    ->schema([
                        TextEntry::make('nama'),
                        TextEntry::make('nama_ibu_kandung')
                            ->label('Ibu Kandung'),
                        TextEntry::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->dateTime('d F Y'),
                        TextEntry::make('nik')
                            ->label('NIK')
                            ->copyable()
                            ->badge()
                            ->icon('heroicon-o-document-duplicate'),
                        TextEntry::make('nisn')
                            ->label('NISN')
                            ->copyable()
                            ->badge()
                            ->icon('heroicon-o-document-duplicate'),
                        TextEntry::make('kewarganegaraan'),
                        TextEntry::make('agama'),
                        TextEntry::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->getStateUsing(fn ($record) => match($record->jenis_kelamin) {
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            }),
                        TextEntry::make('pendidikan_terakhir'),
                        TextEntry::make('nomor_hp')
                            ->label('Nomor HP')
                            ->badge()
                            ->icon('heroicon-o-phone')
                            ->copyable(),
                        TextEntry::make('users.email')
                            ->label('Email')
                            ->badge()
                            ->icon('heroicon-o-envelope-open')
                            ->copyable(),
                        TextEntry::make('tempat_lahir'),
                        Section::make()
                            ->description('Alamat')
                            ->schema([
                                TextEntry::make('alamat')
                                    ->hiddenLabel(),
                            ]),
                    ])
                    ->collapsible()
                    ->columns(3)
            ]);
    }
}

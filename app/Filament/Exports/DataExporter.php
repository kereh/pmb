<?php

namespace App\Filament\Exports;

use App\Models\Data;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DataExporter extends Exporter
{
    protected static ?string $model = Data::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('pas_foto')
                ->label('Pas Foto'),
            ExportColumn::make('nama'),
            ExportColumn::make('nik'),
            ExportColumn::make('nisn'),
            ExportColumn::make('nama_ibu_kandung')
                ->label('Nama Ibu Kandung'),
            ExportColumn::make('ijazah_atau_skl')
                ->label('Ijazah/SKL'),
            ExportColumn::make('kip')
                ->label('KIP'),
            ExportColumn::make('users.email')
                ->label('Email'),
            ExportColumn::make('nomor_hp')
                ->label('Nomor HP'),
            ExportColumn::make('kewarganegaraan'),
            ExportColumn::make('alamat'),
            ExportColumn::make('tempat_lahir')
                ->label('Tempat Lahir'),
            ExportColumn::make('tanggal_lahir')
                ->label('Tanggal Lahir'),
            ExportColumn::make('agama'),
            ExportColumn::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->getStateUsing(fn (object $record): string => $record->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'),
            ExportColumn::make('pendidikan_terakhir')
                ->label('Pendidikan Terakhir'),
            ExportColumn::make('program_studi.nama')
                ->label('Program Studi'),
            ExportColumn::make('users.payment.status')
                ->label('Status Pembayaran')
                ->getStateUsing(fn (object $record): string => match($record->users->payments->status) {
                    0 => 'Belum Lunas',
                    1 => 'Lunas',
                }),
            ExportColumn::make('users.seleksi.status')
                ->label('Status Seleksi')
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your data export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

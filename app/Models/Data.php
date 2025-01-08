<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Data extends Model {
    use HasUuids;

    protected $fillable = [
        'nik',
        'nisn',
        'pas_foto',
        'nama',
        'nama_ibu_kandung',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'nomor_hp',
        'jenis_kelamin',
        'agama',
        'pendidikan_terakhir',
        'kewarganegaraan',
        'program_studi_id',
        'ijazah_atau_skl',
        'kip',
    ];

    public function users(): HasOne {
        return $this->hasOne(User::class, 'data_id');
    }

    public function program_studi(): BelongsTo {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}

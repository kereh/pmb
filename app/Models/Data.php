<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string|null $user_id
 * @property string $nama
 * @property string $jurusan
 * @property string $tanggal_lahir
 * @property string $no_telp_pribadi
 * @property string $no_telp_orang_tua
 * @property string $asal_daerah_provinsi
 * @property string $asal_daerah_kabupaten_kota
 * @property string $asal_sekolah
 * @property string|null $rekomendasi
 * @property string $jenis_kelamin
 * @property string $agama
 * @property string $pas_foto
 * @property string|null $ijazah
 * @property string $ktp
 * @property string $kk
 * @property string|null $kip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProgramStudi> $program_studi
 * @property-read int|null $program_studi_count
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereAgama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereAsalDaerahKabupatenKota($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereAsalDaerahProvinsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereAsalSekolah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereIjazah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereJurusan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereKip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereKk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereKtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereNoTelpOrangTua($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereNoTelpPribadi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data wherePasFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereRekomendasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Data whereUserId($value)
 * @mixin \Eloquent
 */
class Data extends Model {
    use HasUuids;

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program_studi(): BelongsToMany {
        return $this->belongsToMany(ProgramStudi::class, 'data_prodi_pivot', 'data_id', 'program_studi_id');
    }
}

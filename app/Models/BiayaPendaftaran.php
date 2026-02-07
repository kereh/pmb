<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $biaya
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BiayaPendaftaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BiayaPendaftaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BiayaPendaftaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BiayaPendaftaran whereBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BiayaPendaftaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BiayaPendaftaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BiayaPendaftaran whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BiayaPendaftaran extends Model {
    protected $table = 'biaya_pendaftaran';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Data> $data
 * @property-read int|null $data_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramStudi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramStudi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramStudi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramStudi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramStudi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramStudi whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramStudi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProgramStudi extends Model {
    protected $table = 'program_studi';

    public function data(): BelongsToMany {
        return $this->belongsToMany(Data::class, 'data_prodi_pivot', 'program_studi_id', 'data_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProgramStudi extends Model {
    protected $table = 'program_studi';

    public function data(): BelongsToMany {
        return $this->belongsToMany(Data::class, 'data_prodi_pivot', 'program_studi_id', 'data_id');
    }
}

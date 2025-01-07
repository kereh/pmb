<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramStudi extends Model {
    protected $table = 'program_studi';
    protected $fillable = [
        'nama'
    ];

    public function data(): HasMany {
        return $this->hasMany(Data::class, 'program_studi_id');
    }
}

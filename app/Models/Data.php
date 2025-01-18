<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Data extends Model {
    use HasUuids;

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program_studi(): BelongsToMany {
        return $this->belongsToMany(ProgramStudi::class, 'program_studi_id');
    }
}

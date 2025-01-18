<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seleksi extends Model {
    protected $table = 'seleksi';
    
    public function users(): HasMany {
        return $this->hasMany(User::class, 'seleksi_id');
    }
}

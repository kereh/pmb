<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\User;

class Roles extends Model {
    use HasFactory;

    protected $fillable = ['role'];

    public function users(): HasMany {
        return $this->hasMany(User::class, 'role_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seleksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seleksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seleksi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seleksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seleksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seleksi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seleksi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Seleksi extends Model {
    protected $table = 'seleksi';
    
    public function users(): HasMany {
        return $this->hasMany(User::class, 'seleksi_id');
    }
}

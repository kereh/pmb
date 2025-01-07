<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payments extends Model {
    use HasUuids;

    protected $fillable = [
        'user_id',
        'order_id',
        'snap_token',
        'price',
        'status',
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}

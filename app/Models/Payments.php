<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $user_id
 * @property string $order_id
 * @property string $snap_token
 * @property string $price
 * @property string|null $jenis_pembayaran
 * @property string|null $bank
 * @property string|null $waktu_pembayaran
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereJenisPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereSnapToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payments whereWaktuPembayaran($value)
 * @mixin \Eloquent
 */
class Payments extends Model {
    use HasUuids;

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}

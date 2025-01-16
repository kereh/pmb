<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;

use App\Models\Roles;

class User extends Authenticatable implements FilamentUser, HasName {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'role_id',
        'seleksi_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFilamentName(): string {
        return "{$this->nama}";
    }

    public function canAccessPanel(Panel $panel): bool {
        return $panel->auth()->user()->roles->role == 'admin';
    }

    public function roles(): BelongsTo {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function seleksi(): BelongsTo {
        return $this->belongsTo(Seleksi::class, 'seleksi_id');
    }

    public function data(): HasOne {
        return $this->hasOne(Data::class, 'user_id');
    }

    public function payments(): HasOne {
        return $this->hasOne(Payments::class, 'user_id');
    }
}

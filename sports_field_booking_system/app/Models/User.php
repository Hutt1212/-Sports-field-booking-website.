<?php

namespace App\Models;

// ✅ ĐÃ SỬA: Import Enum từ vị trí thực tế của nó
use App\User\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // ✅ ĐÃ SỬA: Sử dụng đúng đường dẫn lớp để cast
            'role' => Role::class,
        ];
    }

    // ... (các phương thức còn lại trong model User của bạn không thay đổi) ...

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(SportsField::class, 'favorites')->withTimestamps();
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }

    public function isUser(): bool
    {
        return $this->role === Role::User;
    }
}

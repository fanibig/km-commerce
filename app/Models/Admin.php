<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    protected $guard_name = 'admin';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'image',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'is_super_admin',
        'is_admin',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = trim(ucfirst($value));
    }

    protected function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = trim(ucfirst($value));
    }

    protected function getFirstNameAttribute(): string
    {
        return ucfirst($this->attributes['first_name']);
    }

    protected function getLastNameAttribute(): string
    {
        return ucfirst($this->attributes['last_name']);
    }

    protected function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'admin_id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsNotActive($query)
    {
        return $query->where('status', 0);
    }

    public function getImageUrlAttribute()
    {
        if (!empty($this->image)) {
            return asset('storage/' . $this->image);
        } else {
            return 'https://via.placeholder.com/150';
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    protected $guard = ['admin'];
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::slug($value);
    }

    public function getRoleNameAttribute()
    {
        return strtolower($this->attributes['name']);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })
            ->when($filters['role'] ?? null, function ($query, $role) {
                $query->where('name', $role);
            });
    }
}

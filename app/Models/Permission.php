<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    protected $table = 'permissions';
    protected $guard = ['admin'];

    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::slug($value);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })
            ->when($filters['permission'] ?? null, function ($query, $permission) {
                $query->whereHas('permissions', function ($query) use ($permission) {
                    $query->where('permissions.name', 'like', '%' . $permission . '%');
                });
            });
    }
}

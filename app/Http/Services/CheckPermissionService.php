<?php

namespace App\Http\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

class CheckPermissionService
{
    public function __construct(string $name)
    {
        // Retrieve permissions from cache or initialize it
        $permissions = Cache::rememberForever('permissions', function () {
            return Permission::pluck('name')->toArray(); // Fetch existing permissions from DB
        });

        // Check if the permission exists in the cached array
        if (!in_array($name, $permissions)) {
            // Create the permission if it doesn't exist
            $permission = Permission::firstOrCreate(['name' => $name]);

            // Add the new permission to the cached array
            $permissions[] = $permission->name;

            // Update the cache
            Cache::put('permissions', $permissions);
        }
    }
}
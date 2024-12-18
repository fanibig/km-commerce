<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cached roles and permissions
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // Define roles and their permissions
        $rolesWithPermissions = [
            'super-admin' => [], // Super Admin gets all permissions
            'admin' => ['dashboard'],
            'manager' => ['dashboard'],
            'customer' => ['dashboard'],
        ];

        // Permissions creating and updating
        $permissions = [
            'catalog-access',
            'users-access',
            'attributes-access',
            'settings-access',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        }

        // Iterate through roles and create/update them
        foreach ($rolesWithPermissions as $roleName => $permissions) {
            // Create or retrieve the role
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'admin',
            ]);

            // Sync permissions for the role
            if ($roleName === 'super-admin') {
                // Assign all permissions to Super Admin
                $role->syncPermissions(Permission::all());
            } else {
                // Assign specific permissions
                $role->syncPermissions($permissions);
            }
        }

        // Assign the Super Admin role to a specific user if they exist
        $superAdminEmail = 'admin@app.test';
        $superAdminUser = \App\Models\Admin::where('email', $superAdminEmail)->first();

        if ($superAdminUser) {
            $superAdminUser->assignRole('super-admin');
        }
    }
}
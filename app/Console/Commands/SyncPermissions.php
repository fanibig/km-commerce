<?php

namespace App\Console\Commands;

use ReflectionClass;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class SyncPermissions extends Command
{
    protected $signature = 'permissions:sync';
    protected $description = 'Sync permissions from routes and controllers';

    public function handle()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guardName = config('common.default_guard_admin'); // Set your guard name

        $this->info("Starting permission sync...");

        $createdPermissions = [];

        // Step 1: Route-Based Permissions
        $this->info("Processing route-based permissions...");
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $action = $route->getAction();
            if (isset($action['middleware']) && in_array('admin', $action['middleware'])) {
                $permissions = explode('|', $action['as'] ?? '');
                foreach ($permissions as $permission) {
                    $permission = trim($permission);
                    if ($permission) {
                        $perm = Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guardName]);
                        if ($perm->wasRecentlyCreated) {
                            $createdPermissions[] = $permission;
                        }
                    }
                }
            }
        }

        // Step 2: Controller-Based Permissions
        $this->info("Processing controller-based permissions...");
        $controllerPath = app_path('Http/Controllers/Admin'); // Path to Admin controllers
        $files = File::allFiles($controllerPath);

        foreach ($files as $file) {
            $className = "App\\Http\\Controllers\\Admin\\" . str_replace('.php', '', $file->getFilename());
            if (class_exists($className)) {
                $reflector = new ReflectionClass($className);

                foreach ($reflector->getMethods() as $method) {
                    if ($method->class == $className && $method->isPublic() && !$method->isConstructor()) {
                        $controllerName = strtolower(str_replace('Controller', '', $reflector->getShortName()));
                        $methodName = strtolower($method->name);

                        $permissionName = $controllerName === $methodName
                            ? $controllerName
                            : "{$controllerName} {$methodName}";

                        $permissionName = str_replace(['&', ' ', '_', '.'], '-', $permissionName);

                        $perm = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => $guardName]);
                        if ($perm->wasRecentlyCreated) {
                            $createdPermissions[] = $permissionName;
                        }
                    }
                }
            }
        }

        // Output created permissions
        if (!empty($createdPermissions)) {
            $this->info("The following permissions were created:");
            foreach ($createdPermissions as $permission) {
                $this->line("- {$permission}");
            }
        } else {
            $this->info("No new permissions were created.");
        }

        $this->info("Permission sync completed successfully!");
        return 0;
    }
}
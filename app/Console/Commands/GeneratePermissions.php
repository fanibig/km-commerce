<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use Spatie\Permission\Models\Permission;

class GeneratePermissions extends Command
{
    protected $signature = 'permissions:generate';
    protected $description = 'Generate permissions based on controller methods';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controllerPath = app_path('Http/Controllers/Admin'); // Path to Admin controllers
        $files = File::allFiles($controllerPath);

        $guardName = 'admin'; // Your guard name
        $createdPermissions = []; // Array to store created permissions

        foreach ($files as $file) {
            $className = "App\\Http\\Controllers\\Admin\\" . str_replace('.php', '', $file->getFilename());
            if (class_exists($className)) {
                $reflector = new ReflectionClass($className);

                foreach ($reflector->getMethods() as $method) {
                    // Check if the method is public and not the constructor
                    if ($method->class == $className && $method->isPublic() && !$method->isConstructor()) {
                        // Generate a unique permission name
                        $controllerName = strtolower(str_replace('Controller', '', $reflector->getShortName()));
                        $methodName = strtolower($method->name);

                        // Avoid duplicates like 'dashboard dashboard'
                        $permissionName = $controllerName === $methodName
                            ? $controllerName
                            : "{$controllerName} {$methodName}";

                        // Clean the permission name by removing spaces and special characters like '-' and '_' or '.'
                        $permissionName = str_replace(['&', ' ', '_', '.'], '-', $permissionName);

                        // Create the permission only if it doesn't already exist
                        $permission = Permission::firstOrCreate(
                            ['name' => $permissionName, 'guard_name' => $guardName]
                        );

                        // Add to the list if newly created
                        if ($permission->wasRecentlyCreated) {
                            $createdPermissions[] = $permissionName;
                        }
                    }
                }
            }
        }

        // Output the list of created permissions
        if (!empty($createdPermissions)) {
            $this->info("Permissions created:");
            foreach ($createdPermissions as $permission) {
                $this->line("- {$permission}");
            }
        } else {
            $this->info("No new permissions were created.");
        }

        return 0;
    }
}
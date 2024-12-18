<?php

namespace App\Http\Middleware;

use Closure;
use SplFileInfo;
use ReflectionClass;
use ReflectionMethod;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Services\CheckPermissionService;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $controllerPath = app_path('Http/Controllers/Admin'); // Path to Admin controllers
        $guardName = 'admin'; // Define the guard name
        $createdPermissions = []; // Array to store created permissions

        // Ensure the directory exists before processing
        if (!File::exists($controllerPath)) {
            throw new \RuntimeException("Controller path does not exist: $controllerPath");
        }

        // Iterate through the files in the Admin controllers directory
        foreach (File::files($controllerPath) as $file) {
            $className = $this->getClassNameFromFile($file);

            if (class_exists($className)) {
                $reflector = new ReflectionClass($className);

                foreach ($reflector->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                    // Skip if the method is not part of the current class or is a constructor
                    if ($method->class !== $className || $method->isConstructor()) {
                        continue;
                    }

                    // Generate a permission name based on the controller and method names
                    $permissionName = $this->generatePermissionName($reflector->getShortName(), $method->name);

                    // Ensure no duplicate permissions are created
                    if (!in_array($permissionName, $createdPermissions)) {
                        // Create the permission if it does not exist
                        Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => $guardName]);

                        // Add the permission to the created permissions list
                        $createdPermissions[] = $permissionName;
                    }

                    // Optionally check or process the permission through a service
                    new CheckPermissionService($permissionName, $guardName);
                }
            }
        }

        return $next($request);
    }

    /**
     * Derive the fully qualified class name from a file.
     *
     * @param SplFileInfo $file
     * @return string
     */
    private function getClassNameFromFile(SplFileInfo $file): string
    {
        $className = str_replace('.php', '', $file->getFilename());
        return "App\\Http\\Controllers\\Admin\\$className";
    }

    /**
     * Generate a cleaned permission name based on controller and method names.
     *
     * @param string $controllerName
     * @param string $methodName
     * @return string
     */
    private function generatePermissionName(string $controllerName, string $methodName): string
    {
        // Remove the 'Controller' suffix and normalize case
        $controller = strtolower(str_replace('Controller', '', $controllerName));
        $method = strtolower($methodName);

        // Avoid duplicates like 'dashboard dashboard'
        $permissionName = $controller === $method ? $controller : "$controller-$method";

        // Replace unwanted characters with hyphens
        return str_replace(['&', ' ', '_', '.'], '-', $permissionName);
    }
}
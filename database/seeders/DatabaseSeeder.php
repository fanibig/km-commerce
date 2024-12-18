<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('permissions:generate');

        $this->call([
            SettingSeeder::class,
            AdminSeeder::class,
            RolePermissionSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ProductTypeSeeder::class,
            PageSeeder::class,
            BrandSeeder::class,
            AttributeSeeder::class,
            AttributeGroupSeeder::class,
            AttributeFamilySeeder::class,
            AttributeOptionSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
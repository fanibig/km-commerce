<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_types')->delete();

        DB::table('product_types')->insert([
            ['title' => 'Simple', 'slug' => Str::slug('Simple', '-'), 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Configurable', 'slug' => Str::slug('Configurable', '-'), 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Grouped', 'slug' => Str::slug('Grouped', '-'), 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Virtual', 'slug' => Str::slug('Virtual', '-'), 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Bundle', 'slug' => Str::slug('Bundle', '-'), 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Downloadable', 'slug' => Str::slug('Downloadable', '-'), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
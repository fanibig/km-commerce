<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->delete();

        DB::table('tags')->insert([
            [
                'title' => 'Clothing',
                'slug' => Str::slug('Clothing', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Shoes',
                'slug' => Str::slug('Shoes', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Accessories',
                'slug' => Str::slug('Accessories', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Electronics',
                'slug' => Str::slug('Electronics', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Home D
                cor',
                'slug' => Str::slug('Home Decor', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Furniture',
                'slug' => Str::slug('Furniture', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Books',
                'slug' => Str::slug('Books', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Toys',
                'slug' => Str::slug('Toys', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Beauty',
                'slug' => Str::slug('Beauty', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Health',
                'slug' => Str::slug('Health', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Sports',
                'slug' => Str::slug('Sports', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Outdoor',
                'slug' => Str::slug('Outdoor', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Food',
                'slug' => Str::slug('Food', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Jewelry',
                'slug' => Str::slug('Jewelry', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Gadgets',
                'slug' => Str::slug('Gadgets', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Art',
                'slug' => Str::slug('Art', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Crafts',
                'slug' => Str::slug('Crafts', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Gifts',
                'slug' => Str::slug('Gifts', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Travel',
                'slug' => Str::slug('Travel', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Pets ',
                'slug' => Str::slug('Pets', '-'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed eos ut repellat cumque quos obcaecati illo dolorem maiores nulla, reprehenderit architecto aut doloremque totam distinctio fugit inventore doloribus, explicabo modi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $category = new Category();
        // $category->title = 'Uncategorized';
        // $category->slug = 'uncategorized';
        // $category->save();

        // Category::factory(20)->create();

        $categories = [
            [
                'id' => 1,
                'title' => 'Tablets',
                'slug' => Str::slug('Tablets'),
                'description' => 'Variety of tablets and accessories',
                'status' => 1,
                'meta_keywords' => 'tablets, electronics, devices',
                'parent_id' => null,
                '_lft' => 7,
                '_rgt' => 8
            ],
            [
                'id' => 2,
                'title' => 'Wearable Tech',
                'slug' => Str::slug('Wearable Tech'),
                'description' => 'Smartwatches and fitness trackers',
                'status' => 1,
                'meta_keywords' => 'wearable tech, smartwatches, fitness trackers',
                'parent_id' => 1,
                '_lft' => 9,
                '_rgt' => 10
            ],
            [
                'id' => 3,
                'title' => 'Cameras',
                'slug' => Str::slug('Cameras'),
                'description' => 'Digital cameras and accessories',
                'status' => 1,
                'meta_keywords' => 'cameras, photography, electronics',
                'parent_id' => 1,
                '_lft' => 11,
                '_rgt' => 12
            ],
            [
                'id' => 4,
                'title' => 'Home Appliances',
                'slug' => Str::slug('Home Appliances'),
                'description' => 'Appliances for home use',
                'status' => 1,
                'meta_keywords' => 'home appliances, kitchen, electronics',
                'parent_id' => null,
                '_lft' => 13,
                '_rgt' => 14
            ],
            [
                'id' => 5,
                'title' => 'Refrigerators',
                'slug' => Str::slug('Refrigerators'),
                'description' => 'Various types of refrigerators',
                'status' => 1,
                'meta_keywords' => 'refrigerators, home appliances, kitchen',
                'parent_id' => 4,
                '_lft' => 15,
                '_rgt' => 16
            ],
            [
                'id' => 6,
                'title' => 'Washing Machines',
                'slug' => Str::slug('Washing Machines'),
                'description' => 'Washing machines and dryers',
                'status' => 1,
                'meta_keywords' => 'washing machines, dryers, home appliances',
                'parent_id' => 4,
                '_lft' => 17,
                '_rgt' => 18
            ],
            [
                'id' => 7,
                'title' => 'Microwaves',
                'slug' => Str::slug('Microwaves'),
                'description' => 'Microwave ovens',
                'status' => 1,
                'meta_keywords' => 'microwaves, kitchen appliances, home appliances',
                'parent_id' => null,
                '_lft' => 19,
                '_rgt' => 20
            ],
            [
                'id' => 8,
                'title' => 'Air Conditioners',
                'slug' => Str::slug('Air Conditioners'),
                'description' => 'Air conditioners and coolers',
                'status' => 1,
                'meta_keywords' => 'air conditioners, coolers, home appliances',
                'parent_id' => 7,
                '_lft' => 21,
                '_rgt' => 22
            ],
            [
                'id' => 9,
                'title' => 'Fashion',
                'slug' => Str::slug('Fashion'),
                'description' => 'Latest fashion trends and accessories',
                'status' => 1,
                'meta_keywords' => 'fashion, clothing, accessories',
                'parent_id' => null,
                '_lft' => 23,
                '_rgt' => 24
            ],
            [
                'id' => 10,
                'title' => 'Men\'s Clothing',
                'slug' => Str::slug('Mens Clothing'),
                'description' => 'Clothing for men',
                'status' => 1,
                'meta_keywords' => 'men\'s clothing, fashion, men',
                'parent_id' => 9,
                '_lft' => 25,
                '_rgt' => 26
            ],
            [
                'id' => 11,
                'title' => 'Women\'s Clothing',
                'slug' => Str::slug('Women\'s Clothing'),
                'description' => 'Clothing for women',
                'status' => 1,
                'meta_keywords' => 'women\'s clothing, fashion, women',
                'parent_id' => 9,
                '_lft' => 27,
                '_rgt' => 28
            ],
            [
                'id' => 12,
                'title' => 'Kids\' Clothing',
                'slug' => Str::slug('Kids Clothing'),
                'description' => 'Clothing for kids',
                'status' => 1,
                'meta_keywords' => 'kids\' clothing, fashion, children',
                'parent_id' => null,
                '_lft' => 29,
                '_rgt' => 30
            ],
            [
                'id' => 13,
                'title' => 'Shoes',
                'slug' => Str::slug('Shoes'),
                'description' => 'Various types of shoes',
                'status' => 1,
                'meta_keywords' => 'shoes, footwear, fashion',
                'parent_id' => 12,
                '_lft' => 31,
                '_rgt' => 32
            ],
            [
                'id' => 14,
                'title' => 'Accessories',
                'slug' => Str::slug('Accessories'),
                'description' => 'Fashion accessories',
                'status' => 1,
                'meta_keywords' => 'accessories, fashion, jewelry',
                'parent_id' => 12,
                '_lft' => 33,
                '_rgt' => 34
            ],
            [
                'id' => 15,
                'title' => 'Sportswear',
                'slug' => Str::slug('Sportswear'),
                'description' => 'Clothing for sports and active wear',
                'status' => 1,
                'meta_keywords' => 'sportswear, active wear, fashion',
                'parent_id' => 12,
                '_lft' => 35,
                '_rgt' => 36
            ],
            [
                'id' => 16,
                'title' => 'Beauty & Health',
                'slug' => Str::slug('Beauty & Health'),
                'description' => 'Beauty and health products',
                'status' => 1,
                'meta_keywords' => 'beauty, health, skincare',
                'parent_id' => null,
                '_lft' => 37,
                '_rgt' => 38
            ],
            [
                'id' => 17,
                'title' => 'Makeup',
                'slug' => Str::slug('Makeup'),
                'description' => 'Makeup products and accessories',
                'status' => 1,
                'meta_keywords' => 'makeup, beauty, cosmetics',
                'parent_id' => 16,
                '_lft' => 39,
                '_rgt' => 40
            ],
            [
                'id' => 18,
                'title' => 'Skincare',
                'slug' => Str::slug('Skincare'),
                'description' => 'Skincare products',
                'status' => 1,
                'meta_keywords' => 'skincare, beauty, health',
                'parent_id' => 16,
                '_lft' => 41,
                '_rgt' => 42
            ],
            [
                'id' => 19,
                'title' => 'Haircare',
                'slug' => Str::slug('Haircare'),
                'description' => 'Haircare products',
                'status' => 1,
                'meta_keywords' => 'haircare, beauty, hair',
                'parent_id' => 18,
                '_lft' => 43,
                '_rgt' => 44
            ],
            [
                'id' => 20,
                'title' => 'Fragrances',
                'slug' => Str::slug('Fragrances'),
                'description' => 'Perfumes and fragrances',
                'status' => 1,
                'meta_keywords' => 'fragrances, perfumes, beauty',
                'parent_id' => 18,
                '_lft' => 45,
                '_rgt' => 46
            ],
            [
                'id' => 21,
                'title' => 'Healthcare Devices',
                'slug' => Str::slug('Healthcare Devices'),
                'description' => 'Healthcare and wellness devices',
                'status' => 1,
                'meta_keywords' => 'healthcare, wellness, devices',
                'parent_id' => 18,
                '_lft' => 47,
                '_rgt' => 48
            ],
            [
                'id' => 22,
                'title' => 'Sports & Outdoors',
                'slug' => Str::slug('Sports & Outdoors'),
                'description' => 'Sports equipment and outdoor gear',
                'status' => 1,
                'meta_keywords' => 'sports, outdoors, equipment',
                'parent_id' => null,
                '_lft' => 49,
                '_rgt' => 50
            ],
            [
                'id' => 23,
                'title' => 'Exercise Equipment',
                'slug' => Str::slug('Exercise Equipment'),
                'description' => 'Exercise and fitness equipment',
                'status' => 1,
                'meta_keywords' => 'exercise, fitness, equipment',
                'parent_id' => null,
                '_lft' => 51,
                '_rgt' => 52
            ],
            [
                'id' => 24,
                'title' => 'Outdoor Gear',
                'slug' => Str::slug('Outdoor Gear'),
                'description' => 'Gear for outdoor activities',
                'status' => 1,
                'meta_keywords' => 'outdoor gear, sports, outdoors',
                'parent_id' => 23,
                '_lft' => 53,
                '_rgt' => 54
            ],
            [
                'id' => 25,
                'title' => 'Camping & Hiking',
                'slug' => Str::slug('Camping & Hiking'),
                'description' => 'Camping and hiking equipment',
                'status' => 1,
                'meta_keywords' => 'camping, hiking, outdoors',
                'parent_id' => 23,
                '_lft' => 55,
                '_rgt' => 56
            ],
            [
                'id' => 26,
                'title' => 'Cycling',
                'slug' => Str::slug('Cycling'),
                'description' => 'Cycling equipment and accessories',
                'status' => 1,
                'meta_keywords' => 'cycling, bikes, sports',
                'parent_id' => 23,
                '_lft' => 57,
                '_rgt' => 58
            ],
            [
                'id' => 27,
                'title' => 'Fishing',
                'slug' => Str::slug('Fishing'),
                'description' => 'Fishing gear and accessories',
                'status' => 1,
                'meta_keywords' => 'fishing, gear, outdoors',
                'parent_id' => 23,
                '_lft' => 59,
                '_rgt' => 60
            ],
            [
                'id' => 28,
                'title' => 'Automotive',
                'slug' => Str::slug('Automotive'),
                'description' => 'Automotive parts and accessories',
                'status' => 1,
                'meta_keywords' => 'automotive, cars, accessories',
                'parent_id' => null,
                '_lft' => 61,
                '_rgt' => 62
            ],
            [
                'id' => 29,
                'title' => 'Car Electronics',
                'slug' => Str::slug('Car Electronics'),
                'description' => 'Car electronics and accessories',
                'status' => 1,
                'meta_keywords' => 'car electronics, automotive, accessories',
                'parent_id' => null,
                '_lft' => 63,
                '_rgt' => 64
            ],
            [
                'id' => 30,
                'title' => 'Car Accessories',
                'slug' => Str::slug('Car Accessories'),
                'description' => 'Various car accessories',
                'status' => 1,
                'meta_keywords' => 'car accessories, automotive, parts',
                'parent_id' => 29,
                '_lft' => 65,
                '_rgt' => 66
            ],
            [
                'id' => 31,
                'title' => 'Motorcycle Parts',
                'slug' => Str::slug('Motorcycle Parts'),
                'description' => 'Motorcycle parts and accessories',
                'status' => 1,
                'meta_keywords' => 'motorcycle parts, automotive, bikes',
                'parent_id' => 29,
                '_lft' => 67,
                '_rgt' => 68
            ],
            [
                'id' => 32,
                'title' => 'Tools & Equipment',
                'slug' => Str::slug('Tools & Equipment'),
                'description' => 'Automotive tools and equipment',
                'status' => 1,
                'meta_keywords' => 'tools, equipment, automotive',
                'parent_id' => 29,
                '_lft' => 69,
                '_rgt' => 70
            ],
            [
                'id' => 33,
                'title' => 'Books',
                'slug' => Str::slug('Books'),
                'description' => 'Books across various genres',
                'status' => 1,
                'meta_keywords' => 'books, reading, literature',
                'parent_id' => null,
                '_lft' => 71,
                '_rgt' => 72
            ],
            [
                'id' => 34,
                'title' => 'Fiction',
                'slug' => Str::slug('Fiction'),
                'description' => 'Fiction books',
                'status' => 1,
                'meta_keywords' => 'fiction, books, reading',
                'parent_id' => 33,
                '_lft' => 73,
                '_rgt' => 74
            ],
            [
                'id' => 35,
                'title' => 'Non-Fiction',
                'slug' => Str::slug('Non-Fiction'),
                'description' => 'Non-fiction books',
                'status' => 1,
                'meta_keywords' => 'non-fiction, books, reading',
                'parent_id' => 33,
                '_lft' => 75,
                '_rgt' => 76
            ],
            [
                'id' => 36,
                'title' => 'Children\'s Books',
                'slug' => Str::slug('Children Books'),
                'description' => 'Books for children',
                'status' => 1,
                'meta_keywords' => 'children\'s books, kids, reading',
                'parent_id' => 33,
                '_lft' => 77,
                '_rgt' => 78
            ],
            [
                'id' => 37,
                'title' => 'Educational Books',
                'slug' => Str::slug('Educational Books'),
                'description' => 'Educational books and materials',
                'status' => 1,
                'meta_keywords' => 'educational books, learning, reading',
                'parent_id' => 34,
                '_lft' => 79,
                '_rgt' => 80
            ],
            [
                'id' => 38,
                'title' => 'Comics',
                'slug' => Str::slug('Comics'),
                'description' => 'Comic books and graphic novels',
                'status' => 1,
                'meta_keywords' => 'comics, graphic novels, books',
                'parent_id' => 34,
                '_lft' => 81,
                '_rgt' => 82
            ],
            [
                'id' => 39,
                'title' => 'Stationery',
                'slug' => Str::slug('Stationery'),
                'description' => 'Stationery and office supplies',
                'status' => 1,
                'meta_keywords' => 'stationery, office supplies, books',
                'parent_id' => null,
                '_lft' => 83,
                '_rgt' => 84
            ],
            [
                'id' => 40,
                'title' => 'Pens & Pencils',
                'slug' => Str::slug('Pens & Pencils'),
                'description' => 'Pens, pencils, and writing instruments',
                'status' => 1,
                'meta_keywords' => 'pens, pencils, stationery',
                'parent_id' => 39,
                '_lft' => 85,
                '_rgt' => 86
            ],
            [
                'id' => 41,
                'title' => 'Notebooks',
                'slug' => Str::slug('Notebooks'),
                'description' => 'Notebooks and journals',
                'status' => 1,
                'meta_keywords' => 'notebooks, journals, stationery',
                'parent_id' => 40,
                '_lft' => 87,
                '_rgt' => 88
            ],
            [
                'id' => 42,
                'title' => 'Office Supplies',
                'slug' => Str::slug('Office Supplies'),
                'description' => 'Office supplies and accessories',
                'status' => 1,
                'meta_keywords' => 'office supplies, stationery, office',
                'parent_id' => 40,
                '_lft' => 89,
                '_rgt' => 90
            ],
            [
                'id' => 43,
                'title' => 'Art Supplies',
                'slug' => Str::slug('Art Supplies'),
                'description' => 'Art and craft supplies',
                'status' => 1,
                'meta_keywords' => 'art supplies, craft, stationery',
                'parent_id' => 40,
                '_lft' => 91,
                '_rgt' => 92
            ],
            [
                'id' => 44,
                'title' => 'School Supplies',
                'slug' => Str::slug('School Supplies'),
                'description' => 'School supplies for students',
                'status' => 1,
                'meta_keywords' => 'school supplies, stationery, education',
                'parent_id' => 40,
                '_lft' => 93,
                '_rgt' => 94
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\DownloadableProduct;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Create products
        $products = [
            [
                'user_id' => 1,
                'title' => 'Online Consultation',
                'slug' => Str::slug('Online Consultation'),
                'type' => 'virtual',
                'price' => 100.00,
                'sale_price' => 50.00,
                'sku' => generateRandomNumber(5),
                'quantity' => 100,
                'description' => 'An online consultation with our experts.',
            ],
            [
                'user_id' => 1,
                'title' => 'Virtual Yoga Class',
                'slug' => Str::slug('Virtual Yoga Class'),
                'type' => 'virtual',
                'price' => 50.00,
                'sale_price' => 35.00,
                'sku' => generateRandomNumber(5),
                'quantity' => 10,
                'description' => 'A virtual yoga class to help you stay fit and relaxed.',
            ],
            [
                'user_id' => 1,
                'title' => 'E-Book: Laravel for Beginners',
                'slug' => Str::slug('E-Book: Laravel for Beginners'),
                'type' => 'downloadable',
                'price' => 20.00,
                'sale_price' => 0.00,
                'sku' => generateRandomNumber(5),
                'quantity' => 50,
                'description' => 'Learn Laravel with this comprehensive guide.',

            ],
            [
                'user_id' => 1,
                'title' => 'Stock Photos Bundle',
                'slug' => Str::slug('Stock Photos Bundle'),
                'type' => 'downloadable',
                'price' => 30.00,
                'sale_price' => 10.00,
                'sku' => generateRandomNumber(5),
                'quantity' => 1000,
                'description' => 'A bundle of high-quality stock photos for your projects.',
            ],
            [
                'user_id' => 1,
                'title' => 'Stock Photos Bundle 2',
                'slug' => Str::slug('Stock Photos Bundle 2'),
                'type' => 'downloadable',
                'price' => 30.00,
                'sale_price' => 10.00,
                'sku' => generateRandomNumber(5),
                'quantity' => 500,
                'description' => 'A bundle of high-quality stock photos for your projects.',
            ],
            [
                'user_id' => 1,
                'title' => 'Sample Product 1',
                'slug' => 'sample-product-1',
                'description' => 'This is a description for Sample Product 1.',
                'price' => 19.99,
                'sale_price' => 0.00,
                'sku' => generateRandomNumber(5),
                'quantity' => 100,
                'type' => 'simple', // Assuming 'type' is a field to differentiate product types
            ],
            [
                'user_id' => 1,
                'title' => 'Sample Product 2',
                'slug' => 'sample-product-2',
                'description' => 'This is a description for Sample Product 2.',
                'price' => 29.99,
                'sale_price' => 0.00,
                'sku' => generateRandomNumber(5),
                'quantity' => 50,
                'type' => 'simple',
            ],
            [
                'user_id' => 1,
                'title' => 'Sample Product 3',
                'slug' => 'sample-product-3',
                'sale_price' => 0.00,
                'description' => 'This is a description for Sample Product 3.',
                'price' => 9.99,
                'sku' => generateRandomNumber(5),
                'quantity' => 200,
                'type' => 'simple',
            ],
        ];

        $fileUrl = [
            'https://example.com/downloads/laravel-for-beginners.pdf',
            'https://example.com/downloads/laravel-for-intermediate.pdf',
            'https://example.com/downloads/laravel-for-advanced.pdf',
        ];

        foreach ($products as $product) {
            // Create the product
            Product::create($product);
        }

        $getProd = Product::where('type', 'downloadable')->get();
        foreach ($getProd as $prod) {
            foreach ($fileUrl as $url) {
                // dd($prod);
                $prod->downloadable()->firstOrCreate([
                    'product_id' => $prod->id,
                    'file_url' => $url,
                    'file_size' => 2.5, // Assuming 2.5 MB; adjust as necessary
                    'file_type' => 'pdf', // Assuming all files are PDFs
                ]);
            }
        }

        // Define the variants data
        $variants = [
            [
                'attributes' => ['Size' => ['M', 'L', 'XL'], 'Color' => ['Red', 'Blue']],
                'price' => 25.00,
                'sku' => generateRandomNumber(5),
            ],
            [
                'attributes' => ['Size' => ['S', 'M', 'L'], 'Color' => ['Blue', 'Green']],
                'price' => 27.00,
                'sku' => generateRandomNumber(5),
            ],
        ];

        // Create variable product with attributes
        $productList = [
            [
                'user_id' => 1,
                'title' => 'T-Shirt',
                'slug' => Str::slug('T-Shirt'),
                'type' => 'variable',
                'sku' => generateRandomNumber(5),
                'attributes' => json_encode(['Size', 'Color']),
                'description' => 'A stylish t-shirt available in different sizes and colors.',
            ],
            [
                'user_id' => 1,
                'title' => 'Sweater',
                'slug' => Str::slug('Sweater'),
                'type' => 'configurable',
                'sku' => generateRandomNumber(5),
                'attributes' => json_encode(['Size', 'Color']),
                'description' => 'A stylish t-shirt available in different sizes and colors.',
            ]
        ];

        foreach ($productList as $prod) {
            $product = Product::firstOrCreate($prod);
            // Iterate over each variant and create product variant records
            foreach ($variants as $variantData) {
                foreach ($variantData['attributes'] as $attributeName => $attributeValues) {
                    foreach ($attributeValues as $attributeValue) {
                        // Prepare the attribute data for bulk insertion
                        $product->variants()->create([
                            'price' => $variantData['price'],
                            'sku' => generateRandomNumber(5),
                            'attribute_name' => $attributeName,
                            'attribute_option' => $attributeValue,
                            'quantity' => random_int(3, 10),
                            'short_description' => 'Short description for ' . $attributeValue,
                            'sale_price' => $variantData['price'] - 5,
                        ]);
                    }
                }
            }
        }

        $categories = Category::all();
        $tags = Tag::all();

        $products = Product::all();

        $products->each(function ($product) use ($categories, $tags) {
            $categories->random(rand(1, 3))->each(function ($category) use ($product) {
                $product->categories()->attach($category->id);
            });
            $tags->random(rand(1, 3))->each(function ($tag) use ($product) {
                $product->tags()->attach($tag->id);
            });
        });
    }
}
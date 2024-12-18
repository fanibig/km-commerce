<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned();
            $table->string('title', 100)->index();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->default('0.00');
            $table->decimal('sale_price', 10, 2)->default('0.00');
            $table->string('status')->default(true);
            $table->string('is_featured')->default(false);
            $table->string('type');
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->json('attributes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('virtual_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('access_period');
            $table->string('download_link')->nullable();
            $table->timestamps();
        });

        Schema::create('downloadable_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('file_url');
            $table->decimal('file_size')->nullable();
            $table->string('file_type')->nullable();
            $table->timestamps();
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('attribute_name');
            $table->string('attribute_option');
            $table->decimal('price', 10, 2)->default('0.00');
            $table->decimal('sale_price', 10, 2)->default('0.00');
            $table->string('sku')->unique();
            $table->unsignedInteger('quantity')->default(0);
            $table->string('image')->nullable();
            $table->string('status')->default(true);
            $table->text('short_description')->nullable();
            $table->string('weight')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('downloadable_products');
        Schema::dropIfExists('virtual_products');
        Schema::dropIfExists('products');
    }
};
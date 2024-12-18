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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug')->unique()->index();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\Category::class, 'parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
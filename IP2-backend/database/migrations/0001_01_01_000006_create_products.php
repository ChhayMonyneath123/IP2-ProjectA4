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
            $table->id('product_id');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->text('image');
            $table->integer('quantity');
            $table->foreignId('category_id')->constrained('categories', 'category_id');
            $table->foreignId('cuisine_id')->nullable()->constrained('cuisines', 'cuisine_id');
            $table->foreignId('beverage_type_id')->nullable()->constrained('beverages', 'beverage_type_id');
            // $table->foreign('beverage_type_id')->references('beverage_type_id')->on('beverages');
            // $table->foreignId('subcategory_id')->nullable()->constrained('subcategories', 'subcategory_id');
            $table->time('delivery_time');
            $table->decimal('rating', 3, 1)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

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
        Schema::create('stocking', function (Blueprint $table) {
            $table->id('stock_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->integer('quantity_available');
            $table->enum('status', ['in stock', 'low', 'out of stock']);
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocking');
    }
};

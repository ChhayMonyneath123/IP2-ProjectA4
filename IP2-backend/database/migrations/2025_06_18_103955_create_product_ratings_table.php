<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                  ->constrained('products', 'product_id')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained('users', 'user_id')  // fixed here
                  ->onDelete('cascade');

            $table->decimal('rating', 2, 1)->unsigned();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_ratings');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('product_ratings')) {
            Schema::create('product_ratings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('product_id');
                $table->foreign('product_id')->references('product_id')->on('products'); // Ensure products table exists
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users'); // Ensure users table exists
                $table->integer('rating');
                $table->text('comment');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('product_ratings');
    }
};

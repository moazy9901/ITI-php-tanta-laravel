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
            // `id` (primary key)
            $table->id();
            // - `name` (string, required)
            $table->string('name');
            // - `description` (text, nullable)
            $table->text('description')->nullable();
            // - `price` (decimal, required)
            $table->decimal('price' , 10 , 2);
            // - `category` (string, required)
            $table->string('category');
            // - `image` (string, nullable) - for storing image filename
            $table->string('image')->nullable();
            // - `stock_quantity` (integer, default 0)
            $table->integer('stock_quantity')->default(0);
            // - `is_active` (boolean, default true)
            $table->boolean('is_active')->default(true);
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

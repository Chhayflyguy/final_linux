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
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Product name
            $table->integer('qty'); // Quantity
            $table->decimal('unit_price', 8, 2); // Unit price with 2 decimal places
            $table->foreignId('category_id') // Foreign key to categories table
                  ->constrained()
                  ->onDelete('cascade'); // When category is deleted, delete related products
            $table->string('product_image')->nullable(); // Product image path, optional
            $table->timestamps(); // created_at and updated_at columns
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

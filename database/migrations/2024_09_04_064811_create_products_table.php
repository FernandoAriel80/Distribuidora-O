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
            $table->integer('catalog_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('bulk_unit_price', 10, 2)->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->integer('percent_off')->nullable();
            $table->boolean('offer');
            $table->decimal('price_offer', 10, 2)->nullable();
            $table->boolean('stock');
            $table->string('image_url');
            $table->unsignedBigInteger('category_id')->nullable(); 
            $table->unsignedBigInteger('type_id')->nullable(); 
            $table->timestamps();

            // Definir llaves foráneas
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
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

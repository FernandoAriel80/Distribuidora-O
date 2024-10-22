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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_id');
            $table->string('name');
            $table->integer('quantity');
            $table->decimal('price',10,2);
            $table->string('url_image');
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->timestamps();

            // Definir llaves foráneas
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

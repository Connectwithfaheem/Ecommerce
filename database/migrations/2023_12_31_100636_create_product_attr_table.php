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
        Schema::create('product_attr', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('sku');
            $table->string('attr_image');
            $table->integer('mrp');
            $table->integer('price');
            $table->integer('qty')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attr');
    }
};

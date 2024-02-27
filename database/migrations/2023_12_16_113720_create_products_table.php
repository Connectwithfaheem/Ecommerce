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
            $table->integer('category_id');
            $table->string('name');
            $table->integer('brand');
            $table->string('image');
            $table->string('model')->nullable();
            $table->longText('short_desc');
            $table->longText('desc')->nullable();
            $table->longText('keywords');
            $table->longText('technical_specification')->nullable();
            $table->longText('uses')->nullable();
            $table->longText('warranty')->nullable();
            $table->string('lead_time');
            $table->integer('tax_id')->nullable();
            $table->integer('is_promo')->nullable();
            $table->integer('is_featured')->nullable();
            $table->integer('is_discounted')->nullable();
            $table->integer('is_tranding')->nullable();
            $table->integer('status');

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

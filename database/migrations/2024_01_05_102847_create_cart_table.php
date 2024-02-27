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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->enum('user_type', ['Reg', 'Not-Reg']);
            $table->integer('qty');
            $table->integer('product_id');
            $table->integer('product_attr_id');
            $table->date('added_on')->format('Y-m-d');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};

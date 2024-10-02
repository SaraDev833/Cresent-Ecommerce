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
            $table->integer('subcategory_id');
            $table->integer('items_id');
            $table->string('product_name');
            $table->integer('brand_id');
            $table->string('sku');
            $table->integer('discount')->default(0);
            $table->string('short_desp');
            $table->text('long_desp');
            $table->string('tag_id');
            $table->integer('views')->default(0);
            $table->string('preview');
            $table->string('slug');
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

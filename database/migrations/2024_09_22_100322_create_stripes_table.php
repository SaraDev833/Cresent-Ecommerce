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
        Schema::create('stripes', function (Blueprint $table) {
            $table->id();
            $table->string('tans_id');
            $table->integer('customer_id');
            $table->integer('total');
            $table->integer('charge');
            $table->string('name');
            $table->string('email');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->string('company');
            $table->integer('phone');
            $table->text('notes');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripes');
    }
};

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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('name')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->bigInteger('code')->nullable();
            $table->integer('price')->nullable();
            $table->integer('sale')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->bigInteger('views')->default(0);
            $table->bigInteger('sells')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('commenting')->default(1);
            $table->integer('rate')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnUpdate()->nullOnDelete();
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

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
        Schema::create('implements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('implement_category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('price_type')->nullable();
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->timestamps();
            $table->foreign('implement_category_id')->references('id')->on('implement_categories')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implements');
    }
};

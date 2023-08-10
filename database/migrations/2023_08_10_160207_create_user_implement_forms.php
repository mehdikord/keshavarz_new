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
        Schema::create('user_implement_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_implement_id');
            $table->unsignedBigInteger('form_id');
            $table->string('data')->nullable();
            $table->timestamps();
            $table->foreign('user_implement_id')->references('id')->on('user_implements')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('form_id')->references('id')->on('forms')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_implement_forms');
    }
};

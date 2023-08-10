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
        Schema::create('implement_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('implement_id');
            $table->unsignedBigInteger('form_id');
            $table->boolean('is_required')->default(0);
            $table->timestamps();
            $table->foreign('implement_id')->references('id')->on('implements')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->foreign('form_id')->references('id')->on('forms')->cascadeOnUpdate()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implement_forms');
    }
};

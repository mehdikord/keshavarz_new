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
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('action')->nullable();
            $table->string('route')->nullable();
            $table->integer('status')->nullable();
            $table->longText('params')->nullable();
            $table->longText('errors')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_logs');
    }
};

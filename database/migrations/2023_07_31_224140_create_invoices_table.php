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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('is_pay')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->bigInteger('code')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('gateway')->nullable();
            $table->string('gateway_id')->nullable();
            $table->string('coupon_price')->nullable();
            $table->boolean('sent')->default(0);
            $table->string('sent_by')->nullable();
            $table->longText('sent_description')->nullable();
            $table->longText('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('shipment_id')->references('id')->on('shipments')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('coupon_id')->references('id')->on('coupons')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

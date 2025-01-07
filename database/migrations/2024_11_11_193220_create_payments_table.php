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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pickupId');
            $table->string('merchant_reference');
            $table->string('payment_account')->nullable();
            $table->string('tracking_id');
            $table->string('amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->string('payment_status_description')->nullable();
            $table->string('redirect_url')->nullable();
            $table->timestamps();
            $table->foreign('pickupId')->references('id')->on('pickups')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

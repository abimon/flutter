<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dustbin_id');
            $table->string('tracking_id')->unique();
            $table->string('date');
            $table->string('time');
            $table->string('location');
            $table->boolean('isPaid')->default(false);
            $table->boolean('isPin')->default(false);
            $table->boolean('isPicked')->default(false);
            $table->timestamps();
            $table->foreign('dustbin_id')->references('id')->on('dustbins')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickups');
    }
};

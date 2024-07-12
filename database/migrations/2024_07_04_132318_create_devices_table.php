<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('device_mac');
            $table->string('device_name')->default('Electrolite');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->boolean('isOn');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
};

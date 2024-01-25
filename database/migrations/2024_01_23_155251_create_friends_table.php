<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->integer('fid');
            $table->bool('accepted')->dafault(false);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('friends');
    }
};

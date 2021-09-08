<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLingkungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //lingkunga_id(pk), nama, flag
    public function up()
    {
        Schema::create('lingkungans', function (Blueprint $table) {
            $table->id('lingkungan_id');
            $table->string('nama')->unique();
            $table->boolean('flag');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lingkungans');
    }
}

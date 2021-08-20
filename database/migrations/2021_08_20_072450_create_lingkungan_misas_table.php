<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLingkunganMisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //lingkungan_misa_id(pk), lingkunagn_id(fk), misa_id(fk), kuota, terdaftar
    public function up()
    {
        Schema::create('lingkungan_misas', function (Blueprint $table) {
            $table->id('lingkungan_misa_id');
            $table->foreignId('lingkungan_id');
            $table->foreignId('misa_id');
            $table->integer('kuota');
            $table->integer('terdaftar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lingkungan_misas');
    }
}

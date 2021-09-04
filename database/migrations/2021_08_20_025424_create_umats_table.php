<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //umat_id(pk), lingkungan_id(fk), nama, nama_babtis, nik, tanggal_lahir, jenis_kelamin, vaksin, hp, [todo...]
    public function up()
    {
        Schema::create('umats', function (Blueprint $table) {
            $table->id('umat_id');
            $table->foreignId('lingkungan_id');
            $table->string('nama')->unique();  //ralat: nama bolh sama
            $table->string('nama_babtis');
            $table->string('nik')->unique();
            $table->string('kk');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('vaksin', ['0', '1', '2', '>2']);
            $table->string('hp');
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
        Schema::dropIfExists('umats');
    }
}

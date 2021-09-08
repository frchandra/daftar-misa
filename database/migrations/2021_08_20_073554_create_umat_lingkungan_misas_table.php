<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmatLingkunganMisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //umat_lingkungan_misa_id(pk), umat_id(fk), lingkunngan_misa_id(fk), [todo qr code]
    public function up()
    {
        Schema::create('umat_lingkungan_misas', function (Blueprint $table) {
            $table->id('umat_lingkungan_misa_id');
            $table->foreignId('umat_id');
            $table->foreignId('lingkungan_misa_id');   
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
        Schema::dropIfExists('umat_lingkungan_misas');
    }
}

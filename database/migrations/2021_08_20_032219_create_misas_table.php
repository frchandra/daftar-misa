<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //misa_id, perayaan, tanggal, jam
    public function up()
    {
        Schema::create('misas', function (Blueprint $table) {
            $table->id('misa_id');
            $table->string('perayaan');
            $table->time('jam');
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
        Schema::dropIfExists('misas');
    }
}

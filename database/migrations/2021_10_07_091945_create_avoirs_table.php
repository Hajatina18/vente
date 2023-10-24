<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvoirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avoirs', function (Blueprint $table) {
            $table->id('id_avoir');
            $table->bigInteger('id_unite');
            $table->string('ref_prod');
            $table->integer('prix')->unsigned();
            $table->double('qte_unite');
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
        Schema::dropIfExists('avoirs');
    }
}

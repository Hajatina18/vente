<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferts', function (Blueprint $table) {
            $table->id('id_transfert');
            $table->string('bon_de_transfert');
            $table->integer('quantite_transfert');
            $table->bigInteger('id_demandeur')->unsigned()->index();
            $table->bigInteger('id_approvisionneur')->unsigned()->index();
            $table->date('date_transfert');
            $table->foreign('id_demandeur')->references('id_depot')->on('depots');
            $table->foreign('id_approvisionneur')->references('id_depot')->on('depots');
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
        Schema::dropIfExists('transferts');
    }
}

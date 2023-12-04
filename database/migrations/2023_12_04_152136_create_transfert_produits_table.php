<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfertProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfert_produits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_transfert');
            $table->string('ref_prod');
            $table->bigInteger('id_unite');
            $table->float('qte_transfert');
            $table->foreign('id_transfert')->references('id_transfert')->on('transferts');
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
        Schema::dropIfExists('transfert_produits');
    }
}

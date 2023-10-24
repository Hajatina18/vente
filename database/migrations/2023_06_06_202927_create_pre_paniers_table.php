<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrePaniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_paniers', function (Blueprint $table) {
            $table->id('id_pre_panier');
            $table->bigInteger("id_pre_commande")->unsigned();
            $table->string('ref_prod');
            $table->bigInteger('id_unite')->unsigned();
            $table->integer('prix_produit');
            $table->double('qte_commande')->unsigned();
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
        Schema::dropIfExists('pre_paniers');
    }
}

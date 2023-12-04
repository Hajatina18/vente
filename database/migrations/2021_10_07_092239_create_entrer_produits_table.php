<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrerProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrer_produits', function (Blueprint $table) {
            $table->id('id_entre');
            $table->integer('id_entrer')->unsigned();
            $table->string('ref_prod');
            $table->bigInteger('id_unite');
            $table->float('qte_entrer');
            $table->foreign('id_entrer')->references('id_entrer')->on('entrers');
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
        Schema::dropIfExists('entrer_produits');
    }
}

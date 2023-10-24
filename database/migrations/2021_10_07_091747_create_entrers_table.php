<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrers', function (Blueprint $table) {
            $table->id('id_entrer');
            $table->bigInteger('id_frns', false, true);
            $table->date('date_facture')->nullable();
            $table->string('num_facture')->nullable();
            $table->string('num_bl');
            $table->date('date_echeance')->nullable();
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
        Schema::dropIfExists('entrers');
    }
}

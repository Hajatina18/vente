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
            $table->unsignedInteger('id_entrer')->autoIncrement();
            $table->string('code_art');
            $table->string('pcb');
            $table->bigInteger('id_frns', false, true);
            $table->string('reference_bl_frns');
            $table->date('date_facture')->nullable();
            $table->string('num_facture')->nullable();
            $table->string('num_bl');
            $table->double('prix_achat_ht')-> default(0);
            $table->double('prix_achat_ttc')-> default(0);
            $table->double('cout_trans')-> default(0);
            $table->date('date_echeance')->nullable();
            $table->integer('depot')->default(1)->nullable();
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

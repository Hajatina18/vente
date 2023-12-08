<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_ventes', function (Blueprint $table) {
            $table->integer('id_pdv')->autoIncrement();
            $table->string('nom_pdv');
            $table->string('address_pdv');
            $table->string('telephone_pdv');
            $table->string('nif_pdv');
            $table->string('stat_pdv');
            $table->string('rcs_pdv');
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
        Schema::dropIfExists('point_ventes');
    }
}

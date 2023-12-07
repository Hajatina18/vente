<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPointVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_point_ventes', function (Blueprint $table) {
            $table->id("id_stock_pdv");
            $table->integer("week");
            $table->string('ref_prod')->index();
            $table->float('stock')->default(0);
            $table->integer('id_pdv')->nullable();
            $table->foreign('ref_prod')->references('ref_prod')->on('produits');
            $table->foreign('id_pdv')->references('id_pdv')->on('point_ventes');
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
        Schema::dropIfExists('stock_point_ventes');
    }
}

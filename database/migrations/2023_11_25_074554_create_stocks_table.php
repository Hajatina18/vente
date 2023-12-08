<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('id_stock');
            $table->integer("week");
            $table->string('ref_prod')->index();
            $table->float('stock')->default(0);
            $table->integer('id_unite')->index();
            $table->integer('id_depot')->nullable();
            $table->foreign('ref_prod')->references('ref_prod')->on('produits');
            $table->foreign('id_depot')->references('id_depot')->on('depots');
            $table->foreign('id_unite')->references('id_unite')->on('unite_mesures');
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
        Schema::dropIfExists('stocks');
    }
}

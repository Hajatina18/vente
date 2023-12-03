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
            $table->foreign('ref_prod')->references('ref_prod')->on('produits');
            $table->float('stock')->default(0);
            $table->bigInteger('id_depot')->index()->nullable();
            $table->foreign('id_depot')->references('id_depot')->on('depots');
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

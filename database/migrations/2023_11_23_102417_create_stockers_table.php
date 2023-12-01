<?php

use App\Models\Depot;
use App\Models\Produit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockers', function (Blueprint $table) {
            $table->id('id_stocker');
            $table->integer('qte_stocker')->nullable();
            $table->foreignIdFor(Produit::class);
            $table->foreignIdFor(Depot::class);
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
        Schema::dropIfExists('stockers');
    }
}

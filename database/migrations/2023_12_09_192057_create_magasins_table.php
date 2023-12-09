<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagasinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magasins', function (Blueprint $table) {
            $table->id("id_magasin");
            $table->string('nom_magasin');
            $table->string('adresse_magasin')->nullable();
            $table->string('description_magasin')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->text('logo')->nullable();
            $table->string('nif')->nullable();
            $table->string('stat')->nullable();
            $table->string('rcs')->nullable();
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
        Schema::dropIfExists('magasins');
    }
}

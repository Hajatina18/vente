<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->string('nom');
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('is_admin')->unsigned();
            $table->integer("id_depot")->nullable()->index();
            $table->integer("id_pdv")->nullable()->index();
            
            // $table->foreign('id_depot')->references('id_depot')->on('depots');
            // $table->foreign('id_pdv')->references('id_pdv')->on('point_ventes');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

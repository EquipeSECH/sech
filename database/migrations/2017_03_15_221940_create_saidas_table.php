<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->datetime('data');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idestoque')->unsigned();
            $table->foreign('idestoque')->references('id')->on('estoques')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idprescricao')->unsigned();
            $table->foreign('idprescricao')->references('id')->on('prescricaos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
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
        Schema::drop('saidas');
    }
}

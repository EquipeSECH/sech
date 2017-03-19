<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmaciasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('farmacias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idClinica')->unsigned();
            $table->foreign('idClinica')->references('id')->on('clinicas')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->string('nome');
            $table->string('codigo');
            $table->boolean('central'); //Imagem?
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('farmacias');
    }

}

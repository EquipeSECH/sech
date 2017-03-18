<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('internacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idclinica');
            $table->foreign('idclinica')->references('id')->on('clinicas')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idpaciente');
            $table->foreign('idpaciente')->references('id')->on('pacientes')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idleito');
            $table->foreign('idleito')->references('id')->on('leitos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idcid10');
            $table->foreign('idcid10')->references('id')->on('cid10s')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->date('dataadmissao');
            $table->date('saida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('internacaos');
    }

}

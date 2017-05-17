<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescricaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idinternacao')->unsigned();
            $table->foreign('idinternacao')->references('id')->on('internacaos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->text('dataprescricao');
            $table->text('dataaprovacao')->nullable();
            $table->text('historicoatual');
            $table->text('evolucao');
            $table->text('observacoesmedicas')->nullable();
            $table->integer('status')->default(0);
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
        Schema::drop('prescricaos');
    }
}

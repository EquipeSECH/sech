<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaidamotivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidamotivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->datetime('data');
            $table->text('motivo');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idestoque')->unsigned();
            $table->foreign('idestoque')->references('id')->on('estoques')
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
        Schema::drop('saidamotivos');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_transferencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('motivotransferencia');
            $table->datetime('datapedido');
            $table->datetime('dataaprovacao');
            
            $table->integer('idusuariofarmaceutico')->unsigned();
            $table->foreign('idusuariofarmaceutico')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idmedicamento')->unsigned();
            $table->foreign('idmedicamento')->references('id')->on('medicamentos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('farmaciadestino')->unsigned();
            $table->foreign('farmaciadestino')->references('id')->on('farmacias')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idusuarioenfermeiro')->unsigned();
            $table->foreign('idusuarioenfermeiro')->references('id')->on('users')
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
        Schema::drop('pedido_transferencias');
    }
}

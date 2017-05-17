<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoquesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('estoques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lote');
            $table->integer('quantidadeatual');
            $table->integer('quantidadereserva');
            $table->date('fabricacao');
            $table->date('validade');
            $table->integer('status');
                    
            $table->integer('idmedicamentocomercial')->unsigned();
            $table->foreign('idmedicamentocomercial')->references('id')->on('medicamentos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idfornecedor')->unsigned();
            $table->foreign('idfornecedor')->references('id')->on('fornecedors')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idfarmacia')->unsigned();
            $table->foreign('idfarmacia')->references('id')->on('farmacias')
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
    public function down() {
        Schema::drop('estoques');
    }

}

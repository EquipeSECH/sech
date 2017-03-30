<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table medicamentos
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idformafarmaceutica');
            $table->integer('nomeconteudo');
            $table->double('quantidadeconteudo');
            $table->integer('unidadeconteudo');
            $table->string('codigosimpas')->unique();            
            $table->string('nomecomercial');              
            $table->foreign('idformafarmaceutica')->references('id')-> on('formafarmaceuticas'); 
            $table->timestamps();
        });

        // Create table for associating medicamentos e substanciaativas (Many-to-Many)
        Schema::create('medicamentosubstancias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idmedicamento')->unsigned();;
            $table->integer('idsubstanciaativa')->unsigned();;
            $table->double('quantidadedose');
            $table->integer('unidadedose');              
            $table->timestamps();
            
            $table->unique(['idsubstanciaativa', 'idmedicamento']);

            $table->foreign('idsubstanciaativa')->references('id')->on('substanciaativas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idmedicamento')->references('id')->on('medicamentos')
                ->onUpdate('cascade')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicamentos');
    }
}

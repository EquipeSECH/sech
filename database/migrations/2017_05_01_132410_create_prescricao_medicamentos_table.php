<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescricaoMedicamentosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prescricao_medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idusuario');
            $table->foreign('idusuario')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idinternacao');
            $table->foreign('idinternacao')->references('id')->on('internacaos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->date('dataprescricao');
            $table->date('dataaprovacao')->nullable();
            $table->text('historicoatual');
            $table->text('evolucao');
            $table->text('observacoesmedicas')->nullable();
            $table->int('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('prescricao_medicamentos');
    }

}

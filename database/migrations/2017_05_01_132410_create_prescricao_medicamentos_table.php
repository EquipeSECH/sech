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
            $table->integer('idprescricao');
            $table->foreign('idprescricao')->references('id')->on('prescricaos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('idmedicamento');
            $table->foreign('idmedicamento')->references('id')->on('medicamentos')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('qtdpedida');
            $table->integer('qtdatendida')->default(0);
            $table->text('posologia');
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

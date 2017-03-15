<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeitosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('leitos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leito');
            $table->string('observacao')->nullable();
            $table->integer('idclinica');
            $table->foreign('idclinica')->references('id')->on('clinicas')
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
        Schema::drop('leitos');
    }

}

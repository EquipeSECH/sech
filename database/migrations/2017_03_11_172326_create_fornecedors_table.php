<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cnpj');
            $table->string('nomefantasia');
            $table->string('razaosocial');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('email');
            $table->string('nomeresponsavel');
            $table->string('telefoneresponsavel');
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
        Schema::drop('fornecedors');
    }
}

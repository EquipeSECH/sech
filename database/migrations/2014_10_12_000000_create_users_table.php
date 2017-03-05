<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('cpf');
            $table->string('rg');
            $table->string('codigoprofissional');
            $table->date('nascimento');
            $table->string('telefone');
            $table->string('endereco')->nullable(true)->default(NULL);
            $table->binary('assinatura')->nullable(true)->default(NULL);
            $table->integer('idespecialidade')->nullable(true)->default(NULL);;            
            $table->foreign('idespecialidade')->references('id')-> on('especialidades'); 
            $table->rememberToken();
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
        Schema::drop('users');
    }
}

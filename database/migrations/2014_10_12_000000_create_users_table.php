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
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->string('cogidoprofissional');
            $table->date('nascimento');            
            $table->string('telefone');
            $table->string('endereco');
            $table->binary('assinatura');                               
            $table->integer('idespecialidade')->unsigned();            
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

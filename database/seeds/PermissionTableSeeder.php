<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $permission = [
            //Roles
            [
                'name' => 'role-list',
                'display_name' => 'Listagem de papeis',
                'description' => 'Listar papeis'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Cadastrar papel',
                'description' => 'Cadastrar novo papel'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Editar papel',
                'description' => 'Editar papel'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Excluir papel',
                'description' => 'Excluir papel'
            ],
            // Usuários
            [
                'name' => 'gestao_usuario-list',
                'display_name' => 'Listagem de usuários',
                'description' => 'Listar usuários'
            ],
            [
                'name' => 'gestao_usuario-create',
                'display_name' => 'Cadastrar usuário',
                'description' => 'Cradastrar novo usuário'
            ],
            [
                'name' => 'gestao_usuario-edit',
                'display_name' => 'Editar usuário',
                'description' => 'Editar usuário'
            ],
            [
                'name' => 'gestao_usuario-delete',
                'display_name' => 'Excluir usuário',
                'description' => 'Excluir usuário'
            ],
            
//            // Telas iniciais            
//            [
//                'name' => 'viewTelaProfessor',
//                'display_name' => 'Tela de professor',
//                'description' => 'Tela de professor'
//            ],
//            [
//                'name' => 'viewTelaAdministradorDoSistema',
//                'display_name' => 'Tela de administrador do sistema',
//                'description' => 'Tela de administrador do sistema'
//            ],
//            [
//                'name' => 'relatorioUsuario',
//                'display_name' => 'Gerar relatório de usuários',
//                'description' => 'Gerar relatório de usuários'
//            ],
            
            //Especialidade
            ['name' => 'especialidade-list',
                'display_name' => 'Listagem de especialidades',
                'description' => 'Listar especialidade'
            ],
            [
                'name' => 'especialidade-create',
                'display_name' => 'Cadastrar especialidade',
                'description' => 'Cadastrar nova especialidade'
            ],
            [
                'name' => 'especialidade-edit',
                'display_name' => 'Editar especialidade',
                'description' => 'Editar especialidade existente'
            ],
            [
                'name' => 'especialidade-delete',
                'display_name' => 'Excluir especialidade',
                'description' => 'Delete especialidade'
            ],
            //Forma farmacêutica
            [   'name' => 'formafarmaceutica-list',
                'display_name' => 'Listagem de forma farmacêutica',
                'description' => 'Listar forma farmacêutica'
            ],
            [
                'name' => 'formafarmaceutica-create',
                'display_name' => 'Cadastrar forma farmacêutica',
                'description' => 'Cadastrar nova forma farmacêutica'
            ],
            [
                'name' => 'formafarmaceutica-edit',
                'display_name' => 'Editar forma farmacêutica',
                'description' => 'Editar forma farmacêutica existente'
            ],
            [
                'name' => 'formafarmaceutica-delete',
                'display_name' => 'Excluir forma farmacêutica',
                'description' => 'Delete forma farmacêutica'
            ]
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }

}

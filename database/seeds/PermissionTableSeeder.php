<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

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
            [ 'name' => 'formafarmaceutica-list',
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
            ],
            //Clínicas
            [ 'name' => 'clinica-list',
                'display_name' => 'Listagem de clínicas',
                'description' => 'Listar clínicas'
            ],
            [
                'name' => 'clinica-create',
                'display_name' => 'Cadastrar clínica',
                'description' => 'Cadastrar nova clínica'
            ],
            [
                'name' => 'clinica-edit',
                'display_name' => 'Editar clínica',
                'description' => 'Editar clínica existente'
            ],
            [
                'name' => 'clinica-delete',
                'display_name' => 'Excluir clínica',
                'description' => 'Excluir clínica'
            ],
            //Cid10
            [ 'name' => 'cid-list',
                'display_name' => 'Listagem cid10',
                'description' => 'Listar cid10'
            ],
            [
                'name' => 'cid-create',
                'display_name' => 'Cadastrar cid10',
                'description' => 'Cadastrar nova cid10'
            ],
            [
                'name' => 'cid-edit',
                'display_name' => 'Editar cid10',
                'description' => 'Editar cid10 existente'
            ],
            [
                'name' => 'cid-delete',
                'display_name' => 'Excluir cid10',
                'description' => 'Excluir cid10'
            ],
            //Leito
            [ 'name' => 'leito-list',
                'display_name' => 'Listagem de leitos',
                'description' => 'Listar leitos'
            ],
            [
                'name' => 'leito-create',
                'display_name' => 'Cadastrar leito',
                'description' => 'Cadastrar novo leito'
            ],
            [
                'name' => 'leito-edit',
                'display_name' => 'Editar leito',
                'description' => 'Editar leito existente'
            ],
            [
                'name' => 'leito-delete',
                'display_name' => 'Excluir leito',
                'description' => 'Excluir leito'
            ],
            //Substancia ativa
            [   'name' => 'substanciaativa-list',
                'display_name' => 'Listagem de substância ativa',
                'description' => 'Listar substância ativa' 
            ],
            [
                'name' => 'substanciaativa-create',
                'display_name' => 'Cadastrar substância ativa',
                'description' => 'Cadastrar nova substância ativa'
            ],
            [
                'name' => 'substanciaativa-edit',
                'display_name' => 'Editar substância ativa',
                'description' => 'Editar substância ativa existente'
            ],
            [
                'name' => 'substanciaativa-delete',
                'display_name' => 'Excluir substância ativa',
                'description' => 'Delete substância ativa'
            ]
        ];

        $role = [
            [
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Administrador do Sistema'
            ],
            [
                'name' => 'farmaceutico',
                'display_name' => 'Farmacêutico',
                'description' => 'Gerencia Estoque e aprova prescrições'
            ],
            [
                'name' => 'medico',
                'display_name' => 'Médico',
                'description' => 'Pode prescrever'
            ],
            [
                'name' => 'dentista',
                'display_name' => 'Dentista',
                'description' => 'Pode prescrever'
            ]
            ,
            [
                'name' => 'enfermeiro',
                'display_name' => 'Enfermeiro',
                'description' => 'Solicita medicamentos da farmacia central para as farmácias satélites'
            ]
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
        foreach ($role as $key => $value) {
            Role::create($value);
        }
    }

}

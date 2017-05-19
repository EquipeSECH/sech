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
            ['name' => 'formafarmaceutica-list',
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
            ['name' => 'clinica-list',
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
            ['name' => 'cid-list',
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
            ['name' => 'leito-list',
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
            ['name' => 'substanciaativa-list',
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
            ],
            //Interação medicamentosa
            ['name' => 'interacaomedicamentosa-list',
                'display_name' => 'Listagem de Interação medicamentosa',
                'description' => 'Listar Interação medicamentosa'
            ],
            [
                'name' => 'interacaomedicamentosa-create',
                'display_name' => 'Cadastrar Interação medicamentosa',
                'description' => 'Cadastrar nova Interação medicamentosa'
            ],
            [
                'name' => 'interacaomedicamentosa-edit',
                'display_name' => 'Editar Interação medicamentosa',
                'description' => 'Editar Interação medicamentosa existente'
            ],
            [
                'name' => 'interacaomedicamentosa-delete',
                'display_name' => 'Excluir Interação medicamentosa',
                'description' => 'Delete Interação medicamentosa'
            ],
            //Internacao
            ['name' => 'internacao-list',
                'display_name' => 'Listagem de internações',
                'description' => 'Listar internação'
            ],
            [
                'name' => 'internacao-create',
                'display_name' => 'Cadastrar internacao',
                'description' => 'Cadastrar nova internacao'
            ],
            [
                'name' => 'internacao-edit',
                'display_name' => 'Editar internação',
                'description' => 'Editar internação'
            ],
            [
                'name' => 'internacao-delete',
                'display_name' => 'Excluir internação',
                'description' => 'Excluir internação'
            ],
            //Estoque
            ['name' => 'estoque-list',
                'display_name' => 'Listagem de estoque',
                'description' => 'Listar estoque'
            ],
            [
                'name' => 'estoque-create',
                'display_name' => 'Cadastrar estoque',
                'description' => 'Cadastrar nova estoque'
            ],
            [
                'name' => 'estoque-edit',
                'display_name' => 'Editar estoque',
                'description' => 'Editar estoque'
            ],
            [
                'name' => 'estoque-delete',
                'display_name' => 'Excluir estoque',
                'description' => 'Excluir estoque'
            ],
            //Entrada
            ['name' => 'entrada-list',
                'display_name' => 'Listagem de entrada',
                'description' => 'Listar entrada'
            ],
            [
                'name' => 'entrada-create',
                'display_name' => 'Cadastrar entrada',
                'description' => 'Cadastrar nova entrada'
            ],
            [
                'name' => 'entrada-edit',
                'display_name' => 'Editar entrada',
                'description' => 'Editar entrada'
            ],
            [
                'name' => 'entrada-delete',
                'display_name' => 'Excluir entrada',
                'description' => 'Excluir entrada'
            ],
            //Saida
            [
                'name' => 'saida-list',
                'display_name' => 'Listagem de saida',
                'description' => 'Listar saida'
            ],
            [
                'name' => 'saida-create',
                'display_name' => 'Cadastrar saida',
                'description' => 'Cadastrar nova saida'
            ],
            [
                'name' => 'saida-edit',
                'display_name' => 'Editar saida',
                'description' => 'Editar saida'
            ],
            [
                'name' => 'saida-delete',
                'display_name' => 'Excluir saida',
                'description' => 'Excluir saida'
            ],
            //Saida motivo
            [
                'name' => 'saidamotivo-list',
                'display_name' => 'Listagem de saida por motivo',
                'description' => 'Listar saida por motivo'
            ],
            [
                'name' => 'saidamotivo-create',
                'display_name' => 'Cadastrar saida por motivo',
                'description' => 'Cadastrar nova saida por motivo'
            ],
            [
                'name' => 'saidamotivo-edit',
                'display_name' => 'Editar saida',
                'description' => 'Editar saida'
            ],
            [
                'name' => 'saidamotivo-delete',
                'display_name' => 'Excluir saida por motivo',
                'description' => 'Excluir saida por motivo'
            ],
            //Farmacia
            [ 'name' => 'farmacia-list',
                'display_name' => 'Listagem de farmacia',
                'description' => 'Listar farmacia'
            ],
            [
                'name' => 'farmacia-create',
                'display_name' => 'Cadastrar farmacia',
                'description' => 'Cadastrar nova farmacia'
            ],
            [
                'name' => 'farmacia-edit',
                'display_name' => 'Editar farmacia',
                'description' => 'Editar farmacia'
            ],
            [
                'name' => 'farmacia-delete',
                'display_name' => 'Excluir farmacia',
                'description' => 'Excluir farmacia'
            ],
            //Pedidotranferencia
            [ 'name' => 'pedidotransferencia-list',
                'display_name' => 'Listagem de Pedido de Transferência',
                'description' => 'Listar Pedido de Transferência'
            ],
            [
                'name' => 'pedidotransferencia-create',
                'display_name' => 'Cadastrar Pedido de Transferência',
                'description' => 'Cadastrar novo Pedido de Transferência'
            ],
            [
                'name' => 'pedidotransferencia-edit',
                'display_name' => 'Editar Pedido de Transferência',
                'description' => 'Editar Pedido de Transferência'
            ],
            [
                'name' => 'pedidotransferencia-delete',
                'display_name' => 'Excluir Pedido de Transferência',
                'description' => 'Excluir Pedido de Transferência'
            ],
            //Fornecedor
            [ 'name' => 'fornecedor-list',
                'display_name' => 'Listagem de fornecedor',
                'description' => 'Listar fornecedor'
            ],
            [
                'name' => 'fornecedor-create',
                'display_name' => 'Cadastrar fornecedor',
                'description' => 'Cadastrar novo fornecedor'
            ],
            [
                'name' => 'fornecedor-edit',
                'display_name' => 'Editar fornecedor',
                'description' => 'Editar fornecedor'
            ],
            [
                'name' => 'fornecedor-delete',
                'display_name' => 'Excluir fornecedor',
                'description' => 'Excluir fornecedor'
            ],
            //Medicamento
            [ 'name' => 'medicamento-list',
                'display_name' => 'Listagem de medicamento',
                'description' => 'Listar medicamento'
            ],
            [
                'name' => 'medicamento-create',
                'display_name' => 'Cadastrar medicamento',
                'description' => 'Cadastrar novo medicamento'
            ],
            [
                'name' => 'medicamento-edit',
                'display_name' => 'Editar medicamento',
                'description' => 'Editar medicamento'
            ],
            [
                'name' => 'medicamento-delete',
                'display_name' => 'Excluir medicamento',
                'description' => 'Excluir medicamento'
            ],
            //Prescrição
            [ 'name' => 'prescricao-list',
                'display_name' => 'Listagem de prescrição',
                'description' => 'Listar prescrição'
            ],
            [
                'name' => 'prescricao-create',
                'display_name' => 'Cadastrar prescrição',
                'description' => 'Cadastrar novo prescrição'
            ],
            [
                'name' => 'prescricao-edit',
                'display_name' => 'Editar prescrição',
                'description' => 'Editar prescrição'
            ],
            [
                'name' => 'prescricao-delete',
                'display_name' => 'Excluir prescrição',
                'description' => 'Excluir prescrição'
            ],
            // Telas iniciais
            [
                'name' => 'administrador',
                'display_name' => 'Tela de administrador',
                'description' => 'Tela de administrador'
            ],
            [
                'name' => 'medico',
                'display_name' => 'Tela de medico',
                'description' => 'Tela de medico'
            ],
            [
                'name' => 'farmaceutico',
                'display_name' => 'Tela de farmaceutico',
                'description' => 'Tela de farmaceutico'
            ],
            [
                'name' => 'enfermeiro',
                'display_name' => 'Tela de enfermeiro',
                'description' => 'Tela de enfermeiro'
            ],
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
            ],
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
        foreach ($role as $key => $value) {
            Role::create($value);
        }
    }

}

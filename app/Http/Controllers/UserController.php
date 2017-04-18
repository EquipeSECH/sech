<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Especialidade;
use DB;
use Hash;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data = User::orderBy('id', 'DESC')->paginate(15);
        return view('users.index', compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $especialidades = Especialidade::lists('nomeespecialidade', 'id');
        $roles = Role::lists('display_name', 'id');
        return view('users.create', compact('especialidades', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //dd($request->input('fk_role'));

        $tipo = $request->input('fk_role');

        if ($tipo == "1") {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'fk_role' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'nascimento' => 'required',
                'telefone' => 'required',
                'endereco' => 'required'
            ]);
        } else if ($tipo == "2") {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'fk_role' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'nascimento' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
                'codigoprofissional' => 'required'
            ]);
        } else if ($tipo == "3") {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'fk_role' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'nascimento' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
                'codigoprofissional' => 'required',
                'idespecialidade' => 'required',
                'assinatura' => 'required'
            ]);
        } else if ($tipo == "4") {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'fk_role' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'nascimento' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
                'codigoprofissional' => 'required',
                'idespecialidade' => 'required'
            ]);
        } else if ($tipo == "5") {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'fk_role' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'nascimento' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
                'codigoprofissional' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'fk_role' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'nascimento' => 'required',
                'telefone' => 'required',
                'endereco' => 'required'
            ]);
        }


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        //dd($request->input('fk_role'));

        $user->attachRole($request->input('fk_role'));


        return redirect()->route('users.index')
                        ->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
        $especialidades = Especialidade::lists('nomeespecialidade', 'id');
        $roles = Role::lists('display_name', 'id');
        $userRole = $user->roles->lists('id', 'id')->toArray();

        return view('users.edit', compact('user', 'especialidades', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'fk_role' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'nascimento' => 'required',
            'telefone' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id', $id)->delete();


        $user->attachRole($request->input('fk_role'));


        return redirect()->route('users.index')
                        ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success', 'Usuário excluído com sucesso!');
    }

}

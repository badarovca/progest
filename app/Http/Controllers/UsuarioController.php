<?php

namespace App\Http\Controllers;

use URL;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\progest\repositories\UsuarioRepository;
use App\progest\repositories\SetorRepository;
Use App\User;
Use App\Http\Requests\CriarUsuarioRequest;
Use App\Http\Requests\EditarUsuarioRequest;

class UsuarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $usuarioRepository;
    protected $setorRepository;

    public function __construct(UsuarioRepository $userRepository, SetorRepository $setorRepository) {
        $this->usuarioRepository = $userRepository;
        $this->setorRepository = $setorRepository;
    }

    public function index(Request $input) {
        $input->flash();
        $input = $input->all();
        $filter = $input;
        $filter['paginate'] = 50;
        $usuarios = $this->usuarioRepository->index($filter);
        return view('admin.usuarios.index')->with(compact('usuarios', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $usuario = new User();
        $setores = $this->setorRepository->dataForSelect();
        $roles = $this->usuarioRepository->getRolesForSelect();

        return view('admin.usuarios.create')->with(compact(['usuario', 'setores', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriarUsuarioRequest $request) {
        $this->usuarioRepository->store($request->all());
        return redirect()->route('admin.usuarios.index')->with('success', 'Registro inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (URL::current() != URL::previous()){
            Session::forget('_old_input');
        }
        $usuario = $this->usuarioRepository->show($id);
        $setores = $this->setorRepository->dataForSelect();
        $roles = $this->usuarioRepository->getRolesForSelect();
        return view('admin.usuarios.edit')->with(compact(['usuario', 'setores', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarUsuarioRequest $request, $id) {
        $this->usuarioRepository->update($id, $request->all());
        return redirect()->route('admin.usuarios.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->usuarioRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }

    public function changePassword() {
        return view('auth/redefinir');
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $credentials = $request->only(
                'old_password', 'password'
        );
        $user = \Auth::user();

        if (\Hash::check($credentials['old_password'], $user->password)) {
            $user->password = bcrypt($credentials['password']);
            $user->save();
            return back()->with('success', 'Senha alterada.');
        } else {
            return back()->withErrors(['old_password' => 'Senha atual não confere.']);
        }
    }

}

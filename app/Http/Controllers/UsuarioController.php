<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\UsuarioRepository;
use App\progest\repositories\SetorRepository;
Use App\User;

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

    public function index() {
        $usuarios = $this->usuarioRepository->index();

        return view('admin.usuarios.index')->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $usuario = new User();
        $setores = $this->setorRepository->dataForSelect();
        $roles = ['Nivel1', 'Nivel2'];

        return view('admin.usuarios.create')->with(compact(['usuario', 'setores', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//        dd($request->all());
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
        $usuario = $this->usuarioRepository->show($id);
        $setores = $this->setorRepository->dataForSelect();
        $roles = ['Nivel1', 'Nivel2'];

        return view('admin.usuarios.edit')->with(compact(['usuario', 'setores', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
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

}

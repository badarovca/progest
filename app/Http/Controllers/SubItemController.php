<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\SubItemRepository;
use App\Http\Requests\CriarSubitemRequest;

class SubItemController extends Controller {

    protected $subItemRepository;

    public function __construct(SubItemRepository $subItemRepository) {
        $this->subItemRepository = $subItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $subitens = $this->subItemRepository->index();

        return view('admin.subitens.index')->with(compact('subitens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $subitem = null;
        return view('admin.subitens.create')->with(compact('subitem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriarSubitemRequest $request) {
        $this->subItemRepository->store($request->all());
        return redirect()->route('admin.subitens.index')->with('success', 'Registro inserido com sucesso!');
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
        $subitem = $this->subItemRepository->show($id);
        return view('admin.subitens.edit')->with(compact('subitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->subItemRepository->update($id, $request->all());
        return redirect()->route('admin.subitens.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->subItemRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }
    
//    public function desativar($id) {
//        $this->subItemRepository->desativar($id);
//        return back()->with('success', 'Desativado com sucesso!');
//    }

}

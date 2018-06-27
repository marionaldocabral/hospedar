<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Colaborador;
use App\User;
use Amranidev\Ajaxis\Ajaxis;
use URL;

class ColaboradorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $colaboradors = Colaborador::all();
        return view('colaborador.index',compact('colaboradors'));
    }

    public function create()
    {
        return view('colaborador.create');
    }

    public function store(Request $request)
    {
        $colaborador = new Colaborador();
        $colaborador->nome = $request->nome;
        $colaborador->telefone = $request->telefone;
        $colaborador->funcao = $request->funcao;
        $colaborador->user_id = $request->user_id;
        $colaborador->save();

        return redirect('colaborador')->with('success', 'Colaborador cadastrado com sucesso!');
    }

    public function show($id)
    {
        $colaborador = Colaborador::findOrfail($id);
        return view('colaborador.show',compact('title','colaborador'));
    }

    public function edit($id,Request $request)
    {
        $colaborador = Colaborador::findOrfail($id);
        return view('colaborador.edit',compact('colaborador'));
    }

    public function update($id,Request $request)
    {
        $colaborador = Colaborador::findOrfail($id);
        $colaborador->nome = $request->nome;
        $colaborador->telefone = $request->telefone;
        $colaborador->funcao = $request->funcao;
        $colaborador->user_id = $request->user_id;
        $colaborador->save();

        return redirect('colaborador')->with('success', 'Colaborador atualizado com sucesso!');
    }

    public function destroy($id)
    {
     	$colaborador = Colaborador::findOrfail($id);
        $usuario = User::findOrfail($colaborador->user_id);
        $colaborador->delete();
        if(is_null($usuario) == false)
            $usuario->delete();

        return redirect('colaborador')->with('success', 'Colaborador removido com sucesso!');
    }
}

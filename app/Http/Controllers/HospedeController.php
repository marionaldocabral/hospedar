<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hospede;
use Amranidev\Ajaxis\Ajaxis;
use URL;

class HospedeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hospedes = Hospede::orderBy('nome')->get();
        return view('hospede.index',compact('hospedes'));
    }

    public function create()
    {
        return view('hospede.create');
    }

    public function store(Request $request)
    {
        $codigo = Hospede::where('codigo', $request->codigo)->get();
        if(sizeof($codigo) == 0){
            $hospede = new Hospede();        
            $hospede->codigo = $request->codigo;            
            $hospede->nome = $request->nome;            
            $hospede->cargo = $request->cargo;            
            $hospede->local = $request->local;            
            $hospede->telefone = $request->telefone;           
            $hospede->save();
            return redirect('hospede')->with('success', 'Hóspede cadastrado com sucesso!');
        }
        else{
            return redirect('hospede')->with('success', 'Código já existe!');
        }        
    }

    public function show($id)
    {
        $hospede = Hospede::findOrfail($id);
        return view('hospede.show',compact('hospede'));
    }

    public function edit($id)
    {        
        $hospede = Hospede::findOrfail($id);
        return view('hospede.edit',compact('hospede'));
    }

    public function update($id,Request $request)
    {
        $hospede = Hospede::findOrfail($id);    	
        $hospede->codigo = $request->codigo;        
        $hospede->nome = $request->nome;        
        $hospede->cargo = $request->cargo;        
        $hospede->local = $request->local;
        $telefone = $request->telefone;
        $hospede->telefone = $request->telefone;       
        $hospede->save();
        return redirect('hospede')->with('success', 'Hóspede atualizado com sucesso!');
    }
    
    public function destroy($id)
    {
     	$hospede = Hospede::findOrfail($id);
     	$hospede->delete();
        return redirect('hospede')->with('success', 'Hóspede removido com sucesso!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hospede;
use App\Leito;
use App\Movimentacao;
use Amranidev\Ajaxis\Ajaxis;
use Illuminate\Support\Facades\Response;
use URL;

class HospedeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hospedes = Hospede::orderBy('nome')->paginate(8);
        return view('hospede.index',compact('hospedes'));
    }

    public function create()
    {
        return view('hospede.create');
    }

    public function create_aloque($leito_id, $hospede_codigo)
    {
        return view('hospede.create_aloque', compact('leito_id', 'hospede_codigo'));
    }

    public function alocar(Request $request)
    {
        //criar novo hospede
        $hospede = new Hospede();
        $hospede->codigo = $request->codigo;
        $hospede->nome = $request->nome;            
        $hospede->cargo = $request->cargo;            
        $hospede->local = $request->local;            
        $hospede->telefone = $request->telefone;           
        $hospede->save();

        //hospedando
        $leito = Leito::findOrfail($request->leito_id);
        $leito->hospede_id = $hospede->id;
        $leito->save();

        date_default_timezone_set('America/Sao_Paulo');

        $movimentacao = new Movimentacao();
        $movimentacao->tipo = 'chegada';
        $movimentacao->data = date('d-m-Y');
        $movimentacao->hora = date('H:i');
        $movimentacao->hospede_id = $hospede->id;
        $movimentacao->save();
        
        return redirect('home')->with('success', 'Hóspede cadastrado com sucesso!');        
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
        //verifica se o hospede esta ocupando algum leito
        $leitos = Leito::all();
        foreach ($leitos as $leito) {
            if($leito->hospede_id == $id)
                return redirect('hospede')->with('success', 'Necessário fazer checkout!');
        }
        //senão prossegue removendo registro
        $hospede = Hospede::findOrfail($id);
     	$hospede->delete();
        return redirect('hospede')->with('success', 'Hóspede removido com sucesso!');
    }

    public function busca($codigo){
        $hospede = Hospede::where('codigo',$codigo)->first();
        return Response::json($hospede);
    }
}

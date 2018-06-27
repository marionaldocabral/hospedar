<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leito;
use App\Hospede;
use App\Movimentacao;
use Amranidev\Ajaxis\Ajaxis;
use URL;

class LeitoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Checando se foram criados os leitos e criando caso negativo
        $l = Leito::all();
        if(sizeof($l) == 0){
            for($i = 1; $i <= 50; $i++){
                $leito = new Leito();
                $leito->save();
            }
        }
        //Buscando as tabelas
        $leitos = Leito::where('status','1')->get();
        $hospedes = Hospede::all();
        $movimentacaos = Movimentacao::all();

        return view('leito.index',compact('leitos', 'hospedes', 'movimentacaos'));
    }

    public function create()
    {
         $leitos = Leito::where('status','1')->get();
         if(sizeof($leitos) < 50){
            $indice1 = sizeof($leitos) + 1;
            $indice2 = sizeof($leitos) + 2;
            $leito1 = Leito::findOrfail($indice1);
            $leito2 = Leito::findOrfail($indice2);
            $leito1->status = 1;
            $leito2->status = 1;
            $leito1->save();
            $leito2->save();
            return redirect('leito')->with('success', 'Leitos adicionados com sucesso!');
         }
        return redirect('leito')->with('success', 'Limite atingido. Não é possível adicionar mais leitos!');
    }

    public function remove()
    {
        $leitos = Leito::where('status','1')->get();
        for($i = sizeof($leitos); $i > 0; $i-=2){
            $leito1 = Leito::findOrfail($i);
            $leito2 = Leito::findOrfail($i - 1);
            if($leito1->hospede_id != NULL || $leito2->hospede_id != NULL){
                return redirect('leito')->with('success', 'Leitos ocupados. Impossível remover!');
            }
            $leito1->status = 0;
            $leito2->status = 0;
            $leito1->save();
            $leito2->save();
            break;            
        }
        
        return redirect('leito')->with('success', 'Leitos removidos com sucesso!');
    }

    public function show($id)
    {
        $leito = Leito::findOrfail($id);
        if($leito->hospede_id != NULL){
            $hospede = Hospede::findOrfail($leito->hospede_id);
            $movimentacao = Movimentacao::where([
                ['hospede_id',$hospede->id],
                ['tipo','chegada'],
            ])->get()->last();

            if(!is_null($movimentacao)){
                $data = $movimentacao->data;

                $dia =  substr($data,0,2);
                $mes =  substr($data,3,2);
                $ano =  substr($data,6,9);
                $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
                switch($diasemana){
                    case"0":
                        $diasemana = "Domingo";
                        break;
                    case"1":
                        $diasemana = "Segunda-Feira";
                        break;
                    case"2":
                        $diasemana = "Terça-Feira";
                        break;
                    case"3":
                        $diasemana = "Quarta-Feira";
                        break;
                    case"4":
                        $diasemana = "Quinta-Feira";
                         break;
                    case"5":
                        $diasemana = "Sexta-Feira";
                        break;
                    case"6": $diasemana = "Sábado";
                        break;
                }

                $chegada = $diasemana . ', ' . $data . ', ' . $movimentacao->hora . 'h.';
            }
            else{
                $chegada = NULL;
            }

            

            return view('leito.show', compact('leito', 'hospede', 'chegada'));
        }
        else{
            $hospedes = Hospede::orderBy('nome')->get();
            return view('hospede.index', compact('hospedes', 'id'));
        }        
    }

    public function edit($id)
    {
        $leito = Leito::findOrfail($id);
        $hospede = Hospede::findOrfail($leito->hospede->id);
        return view('leito.show',compact('leito', 'hospede'));
    }

    public function update($id,Request $request)
    {
        $leito = Leito::findOrfail($id);
        $leito->numero = $request->numero;
        $leito->hospede_id = $request->hospede_id;
        $leito->save();

        return redirect('leito');
    }

    public function hospedar($leito_id, $hospede_id)
    {
        //liberando o leito caso já esteja hospedado
        $leitos = Leito::where('hospede_id', $hospede_id)->get();
        foreach ($leitos as $leito) {
            $leito->hospede_id = NULL;
            $leito->save();
        }
        //hospedando
        $leito = Leito::findOrfail($leito_id);
        $leito->hospede_id = $hospede_id;
        $leito->save();

        date_default_timezone_set('America/Sao_Paulo');

        $movimentacao = new Movimentacao();
        $movimentacao->tipo = 'chegada';
        $movimentacao->data = date('d-m-Y');
        $movimentacao->hora = date('H:i');
        $movimentacao->hospede_id = $hospede_id;
        $movimentacao->save();
        
        return redirect('home')->with('success', 'Hospedagem realizada com sucesso!');
    }

    public function liberar($leito_id, $hospede_id)
    {
        $leito = Leito::findOrfail($leito_id);
        $leito->hospede_id = NULL;
        $leito->save();

        date_default_timezone_set('America/Sao_Paulo');

        $movimentacao = new Movimentacao();
        $movimentacao->tipo = 'partida';
        $movimentacao->data = date('d-m-Y');
        $movimentacao->hora = date('H:i');
        $movimentacao->hospede_id = $hospede_id;
        $movimentacao->save();

        return redirect('home')->with('success', 'Leito liberado com sucesso!');
    }

}
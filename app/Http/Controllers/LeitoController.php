<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leito;
use App\Hospede;
use App\Movimentacao;
use App\Restricao;
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
        /*
        * Status possíveis dos leitos
        * 0. Desativado
        * 1. Livre
        * 2. Reservado
        * 3. Ocupado
        */

        //Checando se foram criados os leitos e criando caso negativo
        $l = Leito::all();
        if(sizeof($l) == 0){
            for($i = 1; $i <= 50; $i++){
                $leito = new Leito();
                $leito->save();
            }
        }
        //Buscando as leitos ativos
        $leitos = Leito::whereNotIN('status',[0])->get();
        //buscando demais tabelas
        $hospedes = Hospede::all();

        return view('leito.index',compact('leitos', 'hospedes', 'movimentacaos'));
    }

    public function create()
    {
        $indice1 = 1;
        $indice2 = 2;
        while(true){
            $leito1 = Leito::where('id', $indice1)->first();
            $leito2 = Leito::where('id', $indice2)->first();
            if(sizeof($leito1) == 0 && sizeof($leito2) == 0){
                $leito1 = new Leito();
                $leito2 = new Leito();
                $leito1->status = 1;
                $leito2->status = 1;
                $leito1->save();
                $leito2->save();
                return redirect('leito')->with('success', 'Leitos adicionados com sucesso!');
            }
            if($leito1->status == 0 && $leito2->status == 0){
                $leito1->status = 1;
                $leito2->status = 1;
                $leito1->save();
                $leito2->save();
                return redirect('leito')->with('success', 'Leitos adicionados com sucesso!');
            }
            $indice1 += 2;
            $indice2 += 2;                 
        }
    }

    public function remove()
    {
        $leitos = Leito::all();
        for($i = sizeof($leitos); $i > 0; $i-=2){
            $leito1 = Leito::findOrfail($i);
            $leito2 = Leito::findOrfail($i - 1);
            if($leito1->status == 3 || $leito2->status == 3){
                return redirect('leito')->with('success', 'Leito(s) ocupado(s). Impossível remover!');
            }
            else if($leito1->status == 2 || $leito2->status == 2){
                return redirect('leito')->with('success', 'Leito(s) reservado(s). Impossível remover!');
            }
            else if($leito1->status == 1 || $leito2->status == 1){
                $leito1->status = 0;
                $leito2->status = 0;
                $leito1->save();
                $leito2->save();
                return redirect('leito')->with('success', 'Leitos removidos com sucesso!');
            }
        }
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

            if(!is_null($movimentacao) && $leito->status == 3){
                $data = $movimentacao->data;
                $diasemana = $this->dia_da_semana($data);
                $data = str_replace('-','/',$data);
                $chegada = $diasemana . ', ' . $data . ', ' . $movimentacao->hora . 'h.';
            }
            else{
                $chegada = NULL;
            }
            $restricoes = Restricao::where('hospede_id', $hospede->id)->get();
            return view('leito.show', compact('leito', 'hospede', 'chegada', 'restricoes'));
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
        $msg;
        //liberando o leito caso já esteja hospedado
        $leitoAtual = Leito::where('hospede_id', $hospede_id)->first();
        if(sizeof($leitoAtual) != 0){
            $leitoAtual->hospede_id = NULL;
            $leitoAtual->status = 1;
            $leitoAtual->save();
            $msg = 'Leito atualizado com sucesso!';
        }
        else{
            $msg = 'Hospedagem realizada com sucesso!';
        }

        //hospedando
        $leito = Leito::findOrfail($leito_id);
        $leito->hospede_id = $hospede_id;
        $leito->status = 3;
        $leito->save();

        date_default_timezone_set('America/Sao_Paulo');

        $movimentacao = new Movimentacao();
        $movimentacao->tipo = 'chegada';
        $movimentacao->data = date('d-m-Y');
        $movimentacao->hora = date('H:i');
        $movimentacao->hospede_id = $hospede_id;
        $movimentacao->save();
        
        return redirect('home')->with('success', $msg);
    }

    public function liberar($leito_id, $hospede_id)
    {
        $leito = Leito::findOrfail($leito_id);
        $leito->hospede_id = NULL;
        $leito->status = 1;
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

    public function alocar($leito_id, $hospede_id){
        $leito = Leito::findOrfail($leito_id);
        $hospede = Hospede::findOrfail($hospede_id);
        //verifica se o hóspede já está hospedado
        $eHospede;
        $leitoOcupado = Leito::where('hospede_id', $hospede_id)->first();
        if(sizeof($leitoOcupado) > 0){
            if($leitoOcupado->status == 2){
                return redirect('leito/' . $leitoOcupado->id);
            }
            $eHospede['leito'] = $leitoOcupado->id;
            $eHospede['status'] = true;
        }
        else{
            $eHospede['leito'] = 0;
            $eHospede['status'] = false;
        }
        if($eHospede['status'] == true){
            $movimentacao = Movimentacao::where([
                ['hospede_id',$hospede->id],
                ['tipo','chegada'],
            ])->get()->last();

            $data = $movimentacao->data;
            $diasemana = $this->dia_da_semana($data);
            $data = str_replace('-','/',$data);
            $chegada = $diasemana . ', ' . $data . ', ' . $movimentacao->hora . 'h.';
        }
        else{
            $chegada = NULL;
        }
 
        return view('leito.alocar', compact('leito', 'hospede', 'chegada','eHospede'));
    }

    public function dia_da_semana($data)
    {
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
        return $diasemana;
    }

    public function reservar($leito_id, $hospede_id){
        $leito = Leito::findOrfail($leito_id);
        $leito->hospede_id = $hospede_id;
        $leito->status = 2;
        $leito->save();
        return redirect('home')->with('success', 'Leito reservado com sucesso!');
    }

    public function confirmar($leito_id, $hospede_id){
        $leito = Leito::findOrfail($leito_id);
        $leito->status = 3;
        $leito->save();

        date_default_timezone_set('America/Sao_Paulo');

        $movimentacao = new Movimentacao();
        $movimentacao->tipo = 'chegada';
        $movimentacao->data = date('d-m-Y');
        $movimentacao->hora = date('H:i');
        $movimentacao->hospede_id = $hospede_id;
        $movimentacao->save();

        return redirect('home')->with('success', 'Leito atualizado com sucesso!');
    }

}
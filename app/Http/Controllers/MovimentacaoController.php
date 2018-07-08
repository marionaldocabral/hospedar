<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movimentacao;
use App\Hospede;
use Amranidev\Ajaxis\Ajaxis;
use URL;

class MovimentacaoController extends Controller
{
   
    public function index()
    {
        $movimentacaos = Movimentacao::orderBy('data', 'desc')->orderBy('hora','desc')->paginate(8);
        $dia = [];
        foreach ($movimentacaos as $m) {
        	$dia[$m->id] = $this->dia_da_semana($m->data);
        	$m->data = str_replace('-','/',$m->data);
        }
        $hospedes = Hospede::all();
        return view('movimentacao.index',compact('movimentacaos', 'hospedes', 'dia'));

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
   
}

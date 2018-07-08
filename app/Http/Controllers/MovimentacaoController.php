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
        foreach ($movimentacaos as $m) {
        	$m->data = str_replace('-','/',$m->data);
        }
        $hospedes = Hospede::all();
        return view('movimentacao.index',compact('movimentacaos', 'hospedes'));

    }
   
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Amranidev\Ajaxis\Ajaxis;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Reserva;
use App\Leito;
use App\Hospede;

class PedidoReservaController extends Controller
{

    public function create(){
    	$l = Leito::where([['hospede_id', NULL],['status', 1]])->orderBy('id')->get();
    	$leitos = [];
    	foreach ($l as $leito) {
    		$reserva = Reserva::where('leito_id',$leito->id)->get()->first();
    		if($reserva == NULL){
    			array_push($leitos, $leito);
    		}
    	}
    	return view('reserva.create', compact('leitos'));
    }

    public function store(Request $request){
        $reserva = new Reserva();

        $reserva->leito_id = $request->leito_id;
        $reserva->hospede_codigo = $request->hospede_codigo;
        $reserva->hospede_nome = $request->hospede_nome;
        $reserva->hospede_cargo = $request->hospede_cargo;
        $reserva->hospede_local = $request->hospede_local;
        $reserva->hospede_telefone = $request->hospede_telefone;

        if($request->diabetes != NULL){
            $reserva->diabetes = true;
        }
        if($request->pressao != NULL){
            $reserva->pressao = true;
        }
        if($request->epilepsia != NULL){
            $reserva->epilepsia = true;
        }

        $reserva->hospede_email = $request->hospede_email;
    	$reserva->save();   

    	return view('reserva.confirm');
    }

    public function busca($codigo){
        $hospede = Hospede::where('codigo',$codigo)->first();
        return Response::json($hospede);
    }

}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Amranidev\Ajaxis\Ajaxis;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoDeReserva;
use App\Reserva;
use App\Leito;
use App\Hospede;
use App\Restricao;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$reservas = Reserva::orderBy('leito_id')->get();
    	
    	return view('reserva.index', compact('reservas'));
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrfail($id);        
        //email
        $msg = 'Desculpe, não foi possível efetuar a reserva!';
        Mail::to($reserva->hospede_email)->send(new PedidoDeReserva($msg, $reserva));

        $reserva->delete();
     
        return redirect('reserva')->with('success', 'Reserva removida com sucesso!');
    }

    public function confirmar($id){
        $reserva = Reserva::findOrfail($id);
        $hospede = Hospede::where('codigo', $reserva->hospede_codigo)->first();
        //verifica se ó hospede ja foi cadastrado e cadastra se necessário
        if($hospede == NULL){
            $hospede = new Hospede();
            $hospede->codigo = $reserva->hospede_codigo;
            $hospede->nome = $reserva->hospede_nome;            
            $hospede->cargo = $reserva->hospede_cargo;            
            $hospede->local = $reserva->hospede_local;
            $hospede->telefone = $reserva->hospede_telefone;           
            $hospede->save();
        }
        //verifica se o hospede já esta em algum leito
        $leitos = Leito::all();
        foreach ($leitos as $leito) {
            if(($leito->status == 2 || $leito->status == 3) && $leito->hospede_id == $hospede->id){
                //email
                $msg = 'Desculpe, não foi possível efetuar a reserva!';
                Mail::to($reserva->hospede_email)->send(new PedidoDeReserva($msg, $reserva));

                $reserva->delete();
                return redirect('reserva')->with('success', 'Não foi possível reservar!');
            }
        }
        $leito = Leito::where('id', $reserva->leito_id)->first();
        if($leito->status != 1){
            //email
            $msg = 'Desculpe, não foi possível efetuar a reserva!';
            Mail::to($reserva->hospede_email)->send(new PedidoDeReserva($msg, $reserva));

            $reserva->delete();
            return redirect('reserva')->with('success', 'Não foi possível reservar!');
        }

        $leito->status = 2;
        $leito->hospede_id = $hospede->id;
        $leito->save();

        if($reserva->diabetes == true){
            $restricao = new Restricao();
            $restricao->hospede_id = $hospede->id;
            $restricao->tipo = "Diabetes";
            $restricao->save();
        }
        if($reserva->pressao == true){
            $restricao = new Restricao();
            $restricao->hospede_id = $hospede->id;
            $restricao->tipo = "Pressão Alta";
            $restricao->save();
        }
        if($reserva->epilepsia == true){
            $restricao = new Restricao();
            $restricao->hospede_id = $hospede->id;
            $restricao->tipo = "Epilepsia";
            $restricao->save();
        }
        
        //enviar email
        $msg = 'Sua reserva foi efetuada com sucesso!';
        Mail::to($reserva->hospede_email)->send(new PedidoDeReserva($msg, $reserva));

        $reserva->delete();
        return redirect('home')->with('success', 'Reserva efetuada como sucesso!');
    }

}

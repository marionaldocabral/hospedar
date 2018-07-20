<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leito;
use App\Hospede;
use App\Reserva;
use App\Restricao;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qtdLeitosLivres = Leito::where('status', 1)->count();
        $qtdLeitosReservados = Leito::where('status', 2)->count();
        $qtdLeitosOcupados = Leito::where('status', 3)->count();
        
        $adm = 0;
        $anc = 0;
        $cjm = 0;
        $com = 0;
        $dcn = 0;
        $elc = 0;
        $erg = 0;
        $mus = 0;
        $org = 0;
        $out = 0;

        $leitos = Leito::whereNotIn('status', [0])->get();

        foreach ($leitos as $leito){            
            if($leito->status ==  2 || $leito->status ==  3){
                $hospede = Hospede::findOrFail($leito->hospede_id);
                $leito->setAttribute('hospede', $hospede);
            }
            if($leito->status ==  3){
                if($hospede->cargo == 'Administrador')
                    $adm++;
                else if($hospede->cargo == 'Ancião')
                    $anc++;
                else if($hospede->cargo == 'Cooperador de Jovens e Menores')
                    $cjm++;
                else if($hospede->cargo == 'Cooperador do Ofício Ministerial')
                    $com++;
                else if($hospede->cargo == 'Diácono')
                    $dcn++;
                else if($hospede->cargo == 'Encarregado Local')
                    $elc++;
                else if($hospede->cargo == 'Encarregado Regional')
                    $erg++;
                else if($hospede->cargo == 'Músico')
                    $mus++;
                else if($hospede->cargo == 'Organista')
                    $org++;
                else if($hospede->cargo == 'Outro')
                    $out++;

            }         
            
            if($leito->id % 2) {
                $leitosSuperiores[] = $leito;
            } else {
                $leitosInferiores[] = $leito;
            }            
        }

        $diabeticos = 0;
        $hipertensos = 0;
        $epileticos = 0;
        $restricoes = Restricao::all();
        foreach ($restricoes as $restricao) {
            if($restricao->tipo == 'Diabetes')
                $diabeticos++;
            else if($restricao->tipo == 'Pressão Alta')
                $hipertensos++;
            elseif($restricao->tipo == 'Epilepsia')
                $epileticos++;
        }

        return view('home', compact(
            'leitosSuperiores',
            'leitosInferiores',
            'qtdLeitosLivres',
            'qtdLeitosOcupados',
            'qtdLeitosReservados',
            'adm',
            'anc',
            'cjm',
            'com',
            'dcn',
            'elc',
            'erg',
            'mus',
            'org',
            'out',
            'diabeticos',
            'hipertensos',
            'epileticos'
        ));
    }
}

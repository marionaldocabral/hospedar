<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leito;
use App\Hospede;

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
        $qtdLeitosLivres = Leito::where([
            ['hospede_id', NULL],
            ['status', 1],
        ])->count();
        $qtdLeitosOcupados = Leito::whereNotNull('hospede_id')->count();
        $leitos = Leito::all();
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

        foreach ($leitos as &$leito) {
            if(!is_null($leito->hospede_id)){
                $hospede = Hospede::findOrFail($leito->hospede_id);
                $leito->setAttribute('hospede', $hospede);
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

        return view('home', compact(
            'leitosSuperiores',
            'leitosInferiores',
            'qtdLeitosLivres',
            'qtdLeitosOcupados',
            'adm',
            'anc',
            'cjm',
            'com',
            'dcn',
            'elc',
            'erg',
            'mus',
            'org',
            'out'
        ));
    }
}

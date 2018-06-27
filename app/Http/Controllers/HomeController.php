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
        $leitosSuperiores = Leito::whereIn('id', [1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49])->get();
        $leitosInferiores = Leito::whereIn('id', [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50])->get();
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

        foreach ($leitos as $leito) {
            if(!is_null($leito->hospede_id)){
                $hospede = Hospede::findOrFail($leito->hospede_id);
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

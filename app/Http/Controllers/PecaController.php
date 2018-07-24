<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Peca;
use App\Leito;
use App\Hospede;
use URL;

class PecaController extends Controller
{

    public function index()
    {
        $pecas = Peca::all();
        $hospedes = Hospede::all();
        return view('peca.index',compact('pecas', 'hospedes'));
    }

    public function filter($id)
    {
        $pecas = Peca::where('hospede_id', $id)->get();
        $leito = Leito::where('hospede_id', $id)->first();
        return view('peca.index', compact('pecas', 'leito'));
    }

    public function create($id)
    {   
        return view('peca.create', compact('id'));
    }

    public function store(Request $request)
    {
        $peca = new Peca();
        $peca->tipo = $request->tipo;
        $peca->servico = $request->servico;
        $peca->hospede_id = $request->hospede_id;

        $peca->save();

        return redirect('hospede/' . $peca->hospede_id . '/peca');
    }

    public function destroy($id)
    {
     	$peca = Peca::findOrfail($id);
     	$peca->delete();
        return redirect('peca');
    }

    public function remove($hospede_id, $peca_id)
    {
        $peca = Peca::findOrfail($peca_id);
        $peca->delete();
        return redirect('hospede/' . $hospede_id . '/peca');
    }
}

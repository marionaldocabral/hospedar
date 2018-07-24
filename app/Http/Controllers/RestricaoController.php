<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restricao;
use App\Hospede;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class RestricaoController.
 *
 * @author  The scaffold-interface created at 2018-07-15 06:55:21pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class RestricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $restricaos = Restricao::all();
        $hospedes = Hospede::orderBy('nome')->get();
        return view('restricao.index',compact('restricaos','hospedes'));
    }

    
    
    public function destroy($id)
    {
     	$restricao = Restricao::findOrfail($id);
     	$restricao->delete();
        return URL::to('restricao');
    }
}

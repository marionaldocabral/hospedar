<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Colaborador;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::all();
        $colaboradores = DB::table('colaboradors')
                ->whereNotNull('user_id')
                ->get();
        return view('auth.index', compact('users','colaboradores'));
    }

    public function create()
    {
        $colaboradores = DB::table('colaboradors')
                ->whereNull('user_id')
                ->orderBY('nome')
                ->get();
        
        return view('auth.register', compact('colaboradores'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $colaborador = Colaborador::findOrfail($request['colaborador_id']);
        $colaborador->user_id = $user->id;
        $colaborador->save();

        return redirect('usuario')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function destroy($id)
    {
        $colaborador = Colaborador::where('user_id', $id)->first();
        if(is_null($colaborador) == false){
            $colaborador->user_id = NULL;
            $colaborador->save();
        }
        $user = User::findOrfail($id);
        $user->delete();

        return redirect('usuario')->with('success', 'Usuário removido com sucesso!');
    }
}

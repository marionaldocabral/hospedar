<?php

namespace App\Http\Middleware;

use Closure;
use App\Colaborador;

class UserFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $colaborador = Colaborador::where('user_id', $user->id)->first();
        if ($colaborador->funcao != 'Triagem') {
            return redirect('home')->with('success', 'Desculpe, você não tem autorização para executar essa operação!');
        }

        return $next($request);
    }
}

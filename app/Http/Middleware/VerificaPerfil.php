<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class VerificaPerfil
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
        //dd($request->user()->temPerfil($role));

        $perfis = array_except(func_get_args(), [0,1]);
        
        foreach ($perfis as $perfil) {
            if ($request->user()->temPerfil($perfil)) {
                return $next($request);
            } 
        }
        
        abort(403, 'Seu usuário não pode acessar essa página');
    }
}

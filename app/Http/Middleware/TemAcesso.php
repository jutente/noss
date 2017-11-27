<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class TemAcesso
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
        /* continua se o usuário logado não estiver bloqueado */
        if(Auth::user()->temAcesso()) {
            return $next($request);    
        }

        /*  aborta e chama a view error.403 */
        abort(403, 'Seu usuário não pode acessar essa página');
    }
}

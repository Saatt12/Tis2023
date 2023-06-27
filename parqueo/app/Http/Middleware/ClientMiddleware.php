<?php

namespace App\Http\Middleware;

use App\Models\Rol;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()){
            $role = Rol::findOrFail(auth()->user()->rol_id);
            if($role && $role->nom_role === 'CLIENTE'){
                return redirect()->route('home_client');
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Rol;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        $routes_claims = array(["claims",
                            "claims_messages",
                            "send_claim_message",
                            "messages_emails",
                            "store",
                            "delete",
        ]);
        if(auth()->user()){
            $role = Rol::findOrFail(auth()->user()->rol_id);
            if($role && $role->nom_role === 'CLIENTE'){
                return redirect()->route('home_client');
            }
            if ($role && $role->nom_role === 'PARQUERO' && in_array($request->path(),$routes_claims)){
               return redirect()->route('claims');
            }
        }
        return $next($request);
    }
}

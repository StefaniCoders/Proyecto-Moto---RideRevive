<?php

namespace App\Http\Middleware;

use Closure;

class UserCheck {

    public function handle($request, Closure $next){
        $user = session('id_usuario', '');
        if (!$user) {
            return redirect('/');
        }
        return $next($request);
    }
  
}


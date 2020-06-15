<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
    
        switch ($guard) {
            case 'admins':
                if(Auth::guard($guard)->check()){
                      
                    return redirect()->route('admin.dashboard');
                }
                break;
            case 'students':
                if(Auth::guard($guard)->check()){
                      
                    return redirect()->route('student.dashboard');
                }
                break;
            case 'teachers':
                if(Auth::guard($guard)->check()){
                      
                    return redirect()->route('teacher.dashboard');
                }
                break;
            case 'users':
                if(Auth::guard($guard)->check()){
                      
                    return redirect()->route('userd.dashboard1');
                }
                break;    
            default:
                if(Auth::guard($guard)->check()){

                   return redirect('/home');
                }
                break;
        }
        return $next($request);
    }
}

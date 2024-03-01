<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use session;

class Login
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
        if(session()->get("username")){
            
            return $next($request); 
        }
        if($request->is("login") || $request->is("signup")){
            return $next($request);
        }    
        else{
            return redirect("login")->with("message","You need to log in to access the page");
        }
        
        // $shivam= session()->get("key");
        // echo $shivam;
        // echo "helloo";
        // return $next($request); 
     
    }
}

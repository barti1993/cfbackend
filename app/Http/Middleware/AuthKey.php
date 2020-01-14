<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
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
        //Get POSTed token from request header
        $token = $request->header('api-key');

        //If there is no token specified
        if(is_null($token)){
            //Returns json response 401 (Unauthorized)
            return response()->json(['message'=>'API key not found'], 401);
        }
        //If the token is incorrect
        if($token != 'CFBACKENDTASK'){
            //Returns json response 401 (Unauthorized)
            return response()->json(['message'=>'Incorrect API key'], 401);
        }
        // Yeah! you can go to validation
        return $next($request);
    }
}

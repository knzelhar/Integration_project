<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\AuthController ;
use App\Models\User;

class VerifierEmailEtBouton
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

      
   
     public function handle(Request $request, Closure $next): Response
     {
         $user = User::where('email', $request->email)->first();
 
         if ($user->role == 2) {
             if (!empty($user->remember_token) && $user->email_verified_at !== null) {
                 return $next($request);
             } else {
                 return response()->json(['message' => 'Email not verified'], 403);
             }
         }
 
         return $next($request);
     }
    }


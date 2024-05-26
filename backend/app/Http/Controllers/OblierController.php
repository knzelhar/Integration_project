<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use  App\Models\mot_oublier ;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\mailler;
use Illuminate\Support\Facades\Hash;

class OblierController extends Controller
{
    
    // envoie le code avec un email et reset password : 

    public function sendResetCodee(Request $request)
    {

        echo"hello wordl";
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $user = User::where('email', $request->email)->first();
        if( $user){
        $code = rand(100000, 999999); // Générer un code de réinitialisation aléatoire

        mot_oublier::create(
        [
        'email' => $user->email,
        'code' => $code
        ]
        );

        Mail::to($user->email)->send(new mailler($code));

        return response()->json(['message' => 'Un e-mail avec le code de réinitialisation a été envoyé.']);


        }else{
        return response()->json('invalide cridential');
        }
        
    }

    public function resetPP(Request $request)
    {
        $request->validate([
           // 'email' => 'required|email|exists:users,email',
            'code' => 'required|digits:6',
            'password' => 'required|min:8'
        ]);

        $reset =mot_oublier::where('code', $request->code)->first();
           
           

        if (!$reset) {
            return response()->json(['message' => 'Le code de réinitialisation est incorrect.'], 422);
        }
 
       
       
       
        $user = User::where('email',  $reset->email )->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Supprimer le code de réinitialisation utilisé
        $reset->delete();

        return response()->json(['message' => 'Mot de passe réinitialisé avec succès.']);
    }
 
}
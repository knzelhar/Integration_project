<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\mailler;
use Illuminate\Support\Facades\Hash;
class forgetpassword extends Controller
{
   
    // envoie le code avec un email et reset password : 

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        $code = rand(100000, 999999); // Générer un code de réinitialisation aléatoire

        User::updateOrCreate(
            ['email' => $user->email],
            ['nom' => $code]
        );

        Mail::to($user->email)->send(new mailler($code));

        return response()->json(['message' => 'Un e-mail avec le code de réinitialisation a été envoyé.']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|digits:6',
            'password' => 'required|min:8|confirmed'
        ]);

        $reset = User::where('email', $request->email)
            ->where('nom', $request->code)
            ->first();

        if (!$reset) {
            return response()->json(['message' => 'Le code de réinitialisation est incorrect.'], 422);
        }

        $user = User::where('email', $request->email)->first();
    $user->password = Hash::make($request->password);
        $user->save();

        // Supprimer le code de réinitialisation utilisé
        $reset->delete();

        return response()->json(['message' => 'Mot de passe réinitialisé avec succès.']);
    }
 
   
    
}





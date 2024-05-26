<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\mailler;
use App\Http\Requests\userR;
use Illuminate\Support\Facades\Hash;
use App\Mail\verifierinscription;

class resetpassword extends Controller
{




    public function sendmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $token = Str::random(60);
       // Cette ligne génère une chaîne aléatoire de 60 caractères à l'aide de la méthode random
    
        if ($user) {
            $user->remember_token = Str::random(60);
            $user->save();
    
            Mail::to($user->email)->send(new mailler($user));
    
            return [
                'message' => "Un e-mail de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.",
                'token' => $token,
            ];
        } else {
            return "Aucun utilisateur trouvé avec l'adresse e-mail : " . $email;
        }
    }


    public function resetPassword(Request $request)
    {
        $token = $request->input('token');
        $newPassword = $request->input('password');
    
        // Recherche de l'utilisateur avec le jeton
        $user = User::where('remember_token', $token)->first();
    
        if ($user) {
            // Réinitialisation du mot de passe
            $user->password = $newPassword;
            $user->remember_token = null; // Supprimer le jeton après utilisation
            $user->save();
    
            return [
                'message' => "Votre mot de passe a été réinitialisé avec succès."
            ];
        } else {
            return "Jeton invalide ou expiré. Veuillez réessayer.";
        }
    }


    public function adminR(userR $request)
    {
       
                $user = new User();
                $user->nom = $request['nom'];
                $user->prenom = $request['prenom'];
                $user->email = $request['email'] ; // Use null if email is not provided
                $user->role = '0';
                $user->password = $request['password'];
                $user->remember_token=str::random(40);
                $user->save();
    
             if($user){
             
              $token = $user->createToken('my_token', ['role' => $user->role])->plainTextToken;


    
              // Construct response
              $response = [
                  'user' => $user,
                  'token' => $token,
                  'message'=>"chek your mail"
                 
              ];
  
              return response()->json($response, 201);

             }else{
              return response()->json("404");
             }
              
            }



}

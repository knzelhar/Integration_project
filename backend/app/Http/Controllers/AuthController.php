<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\HasFactory;
use App\Models\animateur_user;
use App\Traits\httpresponses;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use App\Models\parent_user;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\parentRequest;
use App\Http\Requests\userR;
 use App\Http\Requests\animateurRequest;
 use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
 use Illuminate\Foundation\Auth\ResetsPasswords;
 use Illuminate\Support\Facades\Mail;
use App\Mail\testmail;
use App\Http\Requests\forgetpassword;
use App\Mail\mailler;
use Illuminate\Support\Facades\Hash;
use App\Models\enfant;
use App\Mail\verifierinscription;

class AuthController extends Controller
{
    use  HasApiTokens;

// la fonction de login




public function login(Request $request)
{
    // Tentative d'authentification de l'utilisateur
    $credentials = $request->only('email', 'password');

    // Vérification si l'utilisateur existe et si le mot de passe est correct
    if (!Auth::attempt($credentials)) {
        // Retourne une réponse si l'authentification échoue
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Récupération de l'utilisateur authentifié
    $user = Auth::user();

    // Création d'un jeton pour l'utilisateur avec son rôle
    $token = $user->createToken('my_token', ['role' => $user->role])->plainTextToken;

    // Construction de la réponse JSON contenant l'utilisateur et le jeton
    $response = [
        'user' => $user,
        'token' => $token
    ];

    // Retourne la réponse avec le code de statut HTTP 201 (Créé)
    return response()->json($response, 201);
}

    public function logine(Request $request){


        $user= User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password ,$user->password)){
          return response([
              'message'=>'not valide',
              404]);
        }

        $token = $user->createToken('my_token'.$user->role)->plainTextToken;
         $response =[
          'user'=>$user,
          'token'=>$token];
          return response()->json($response,201);

      }

      public function adminR(userR $request)
      {

                  $user = new User();
                  $user->nom = $request['nom'];
                  $user->prenom = $request['prenom'];
                  $user->email = $request['email'] ?? null; // Use null if email is not provided
                  $user->role = '0';
                  $user->password = $request['password'];
                  $user->remember_token=str::random(40);
                  $user->save();

               if(Mail::to( $user->email)->send(new verifierinscription($user))){
                return response()->json("verifier boite email", 201);
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











   public function registerParent(parentRequest $request ){
        //validation des donnees
        $fields = $request->validated();

         $user = new User();
         $user->nom = $fields['nom'];
         $user->prenom = $fields['prenom'];
         $user->email = $fields['email'];
         $user->role = '2';
         $user->password = Hash::make($fields['password']); // Hashage du mot de passe
         $user->remember_token=str::random(40);
         $user->save();

         // Création du parent associé
         $parent = new parent_user();
         $parent->fonction = $fields['fonction'];
         $parent->user_id = $user->id; // Assure-toi d'utiliser le nom correct de la clé étrangère
         $parent->save();

         if(Mail::to( $user->email)->send(new verifierinscription($user))){

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

  public function verify($token){
    $user = User::where('remember_token', '=', $token)->first();

     if (!empty($user->remember_token)) {
     $user->email_verified_at = date('Y-m-d H:i:s');
     $user->save();

      return response()->json("Vérification réussie");
     } else {
        abort(404);
    }

   }



public function registerAnimateur(animateurRequest $request){
        $fields = $request->validated();

         $user = new User();
         $user->nom = $fields['nom'];
         $user->prenom = $fields['prenom'];
         $user->email = $fields['email'];
         $user->role = '1';
         $user->password = Hash::make($fields['password']); // Hashage du mot de passe
         $user->remember_token=str::random(40);
         $user->save();

         $animateur= new animateur_user();
         $animateur->domaine_comp=$fields['domaine_comp'];
         $animateur->user_id = $user->id;
         $animateur->save();
         if(Mail::to( $user->email)->send(new verifierinscription($user))){

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




    public function logout(Request $request ){

       // Récupérer l'utilisateur authentifié
    $user = $request->user();

    // Révoquer le jeton d'authentification actuel de l'utilisateur
    $user->currentAccessToken()->delete();

    // Réponse
    return response()->json([
        'message' => 'Déconnexion réussie.'
    ]);
    }


    public function sendmailveriy(Request $request ){

        if (Mail::to( $request->email)->send(new verifierinscription($request->user))) {
            // Si l'e-mail a été envoyé avec succès
            $email_envoye = true;
            $bouton_clique = true;

            // Vous pouvez effectuer d'autres actions ici si nécessaire

            return response()->json([
                'message' => 'E-mail envoyé et bouton cliqué avec succès',


            ]);
        } else {
            // Si l'envoi de l'e-mail a échoué
            $email_envoye = false;
            $bouton_clique = false;

            // Vous pouvez effectuer d'autres actions ici si nécessaire

            return response()->json([
                'message' => 'Échec de l\'envoi de l\'e-mail',
                'email_envoye' => $email_envoye,
                'bouton_clique' => $bouton_clique,
            ], 500); // Utilisation du code d'erreur HTTP 500 pour indiquer une erreur interne du serveur
        }
    }







}




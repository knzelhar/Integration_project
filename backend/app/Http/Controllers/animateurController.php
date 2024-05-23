<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\animateurRequest;
use App\Models\Animateur_User;


class animateurController extends Controller
{
    public function store(animateurRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'password' => bcrypt($validatedData['password']),
            'role' => 1
        ]);

        $animateur = Animateur_User::create([
            'user_id' => $user->id,
            'domaine_comp' => $request->input('domaine_comp')
        ]);
$user->animateur_user()->save($animateur);

        return response()->json($animateur, 201);

    }
}

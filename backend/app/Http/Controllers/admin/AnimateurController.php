<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Animateur_User;
use App\Models\activite;
use App\Models\User;
use App\Http\Requests\requestanimateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AnimateurController extends Controller
{
    /**
     ? Affichage des animateurs
     */

    public function index()
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0) {
            $animateurs = animateur_user::with('users')->get();
            return response()->json($animateurs);
        }
    }

    /**
     Affichage de l'animateur en details
     */

    public function show($id)
    {
        // $user = Auth::User();
        // $role = $user->role;

        // if ($role === 0) {
            $animateurs = animateur_user::with('users')->findOrFail($id);
            return response()->json($animateurs);
        // }
    }

    /**
     Mise a jour de l'animateur
     */

    public function update(requestanimateur $request, $id)
    {
        $animateur = animateur_user::findOrFail($id);
        $user_id = $animateur->user_id;
        $user = User::findOrFail($user_id);

        $validatedData = $request->validate([
            'domaine_comp' => 'required|string',
            'role' => 'required|integer',
        ]);

        $animateur->domaine_comp = $validatedData['domaine_comp'];
        $user->role = $validatedData['role'];
        $animateur->save();
        $user->save();
        return response()->json([
            'message' => "Animateur $animateur->id mis à jour avec succès",
        ]);
    }
    /**
     Suppression de l'animateur
     */

    public function destroy($id)
    {
        $animateur = Animateur_User::findOrFail($id);
        $animateur->delete();
        return response()->json(['message' => 'Animateur deleted successfully!']);
    }

    /**
     Affectation de l'animateur
     */


    public function affecter(Request $request, $activitId)
    {
        // $user = Auth::User();
        // $role = $user->role;

        // if ($role === 0) {
            $validatedData = $request->validate([
                'animateur_id' => 'required|integer'
            ]);
            // Recherche sur les activite et l'animateur
            $activite = Activite::findOrFail($activitId);

            $animateur = Animateur_User::findOrFail($validatedData['animateur_id']);

            $activite->animateur_id = $validatedData['animateur_id'];

            $activite->save();

            return response()->json([
                'message' => "Animateur $animateur->id assigné à l'activité $activite->id avec succès",
            ]);
        // }
    }
}

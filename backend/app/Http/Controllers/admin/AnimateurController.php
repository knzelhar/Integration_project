<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Animateur_User;
use App\Models\activite;
use App\Models\User;
use App\Http\Requests\requestanimateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $animateurs = User::whereHas('animateur_users')->with('animateur_users')->get();
        return response()->json($animateurs);
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $animateur = User::whereHas('animateur_users')->with('animateur_users')->findOrFail($id);
        return response()->json($animateur);
    }

    /**
     * mise a jour de l'animateur
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
     * suppression de l'animateur
     */

    public function destroy($id)
    {
        $animateur = Animateur_User::findOrFail($id);
        $animateur->delete();
        return response()->json(['message' => 'Animateur deleted successfully!']);
    }

    /**
     *   Affecter un animateur a une activite
    */
    

    public function affecter(Request $request, $id)
   {
    $validatedData = $request->validate([
        'animateur_id' => 'required|integer'
    ]);
    // Recherche sur les activite et l'animateur
    $activite = Activite::findOrFail($id);

    $animateur = Animateur_User::findOrFail($validatedData['animateur_id']);

    $activite->animateur_id = $validatedData['animateur_id'];

    $activite->save();

    return response()->json([
        'message' => "Animateur $animateur->id assigné à l'activité $activite->id avec succès",
    ]);
}


}

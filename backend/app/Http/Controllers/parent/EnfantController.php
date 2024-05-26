<?php

namespace App\Http\Controllers\parent;

use App\Http\Controllers\Controller;
use App\Models\enfant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EnfantController extends Controller
{



     public function get(){
        $user = Auth::User();
        $id = $user->id;
        return response()->json($id);
     }

       /**
? Afficher tous les enfants du parent
     */
     public function index()
     {
         $enfants = enfant::all();
         $result = [];
         foreach ($enfants as $enfant) {
            $age = Carbon::parse($enfant->date_naiss)->age;
             $data = [
                 'nom' => $enfant->nom,
                 'prenom' => $enfant->prenom,
                 'date_naiss' => $enfant->date_naiss,
                 'niveau_etu' => $enfant->niveau_etu
             ];
             $result[] = $data;
         }

         return response()->json($result);
     }

            /**
? Afficher un enfant par son id
     */

public function show($id)
{
    $enfant = Enfant::with('offres','activiteEnfants')->findOrFail($id);

    $offres = $enfant->offres->pluck('titre');
    $activites = $enfant->activiteEnfants->pluck('titre');


    $data = [
        'nom' => $enfant->nom,
        'prenom' => $enfant->prenom,
        'date_naiss' => $enfant->date_naiss,
        'niveau_etu' => $enfant->niveau_etu,
        'offres' => $offres,
        'activites' => $activites
    ];

    return response()->json($data);
}

            /**
? Ajouter un enfant
     */
public function store(Request $request)
{
    if (Auth::check()) {
        $user = Auth::User();
        $parentId = $user->id;
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'niveau_etu' => 'required|string',
            'date_naiss' => 'required|date',
        ]);

        $enfant = Enfant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'niveau_etu' => $request->niveau_etu,
            'date_naiss' => $request->date_naiss,
            'parent_id' => $parentId,
        ]);
        return response()->json($enfant, 201);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}


    /**
? Supprimer un enfant
     */
    public function destroy($id)
    {
        $enfant = enfant::find($id);

        if (!$enfant) {
            return response()->json(['message' => 'enfant not found'], 404);
        }

        $enfant->delete();

        return response()->json(['message' => 'enfant deleted successfully']);
    }
}



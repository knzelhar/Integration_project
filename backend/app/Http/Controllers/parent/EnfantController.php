<?php

namespace App\Http\Controllers\parent;

use App\Http\Controllers\Controller;
use App\Models\enfant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnfantController extends Controller
{

    /**
     ? Afficher tous les enfants
     */

    public function index()
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $enfants = enfant::all();
            $result = [];
            foreach ($enfants as $enfant) {
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
    }

    /**
     ? Afficher un enfant par son id
     */

    public function show($id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $enfant = Enfant::findOrFail($id);

            $offre = Enfant::with('demandeEnfants.offreDemandes')->findOrFail($id);
            $activite = Enfant::with('activiteEnfants')->findOrFail($id);

            $data = [
                'nom' => $enfant->nom,
                'prenom' => $enfant->prenom,
                'date_naiss' => $enfant->date_naiss,
                'niveau_etu' => $enfant->niveau_etu,
                'offres' => $offre ? [
                    'offre' => $offre->titre
                ] : null,
                'activites' => $activite ? [
                    'activite' => $activite->titre
                ] : null
            ];

            return response()->json($data);
        }
    }

    /**
     ? Ajouter un enfant
     */

    public function store(Request $request)
    {
        $user = Auth::User();
        $role = $user->role;
        $parentId = $user->id;

        if ($role === 2) {
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'niveau_etu' => 'required|string',
                'date_naiss' => 'required|string',
            ]);

            $enfant = Enfant::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'niveau_etu' => $request->niveau_etu,
                'date_naiss' => $request->date_naiss,
                'parent_id' =>$parentId,
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
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $enfant = enfant::find($id);

            if (!$enfant) {
                return response()->json(['message' => 'enfant not found'], 404);
            }

            $enfant->delete();

            return response()->json(['message' => 'enfant est supprimé avec succés']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use  App\Models\Offre;
use App\Http\Requests\requestOffre;


class offreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $user = Auth::User();
         $role = $user->role;

    if ($role === 0){
        $offres = Offre::all();
        return response()->json($offres);
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(requestOffre $request)
    {
             // Créer une nouvelle instance du modèle Offre avec les données validées

    $request->validate();

    $offre = Offre::create($request->all());

    // Retournez une réponse JSON indiquant que l'offre a été créée avec succès
    return response()->json(['message' => 'Offre créée avec succès', 'offre' => $offre]);
    }

    /**
     * Display the specified resource.
     */
   
     public function show($id)
     {
         $user = Auth::User();
         $role =$user->role;
        if ($role === 0) {
             $offre = Offre::findOrFail($id);
             return response()->json($offre);
        } else {
             return response()->json(['error' => 'Page not found'], 404);
          }
     }
     

    /**
     * Update the specified resource in storage.
     */
    public function update(requestOffre $request, string $id)
    {
        $offre = Offre::findOrFail($id);
        $offre->update($request->all());
        return response()->json($offre, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Trouvez la ressource à supprimer
         $ressource = Offre::findOrFail($id);

         // Supprimez la ressource
         $ressource->delete();
 
         // Redirigez vers une autre page ou effectuez toute autre action nécessaire
    }
}

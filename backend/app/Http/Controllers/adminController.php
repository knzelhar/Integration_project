<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offre;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //$user = Auth::User();
         //$role = $user->role;

    //if ($role === 0){
        $offres = Offre::all();
        return response()->json($offres);
    //}
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    public function show(string $id)
    {
         //$user = Auth::User();
        //$role = $user->role;

        //if ($role === 0){
            $offre = offre::findOrFail($id);
            return response()->json($offre);
            echo 'hello world';
            //}
            //else{
            //    return response()->json(['error'=>'Page not found'], 404);}
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouvez la ressource à supprimer
        $ressource = Offre::findOrFail($id);

        // Supprimez la ressource
        $ressource->delete();

        // Redirigez vers une autre page ou effectuez toute autre action nécessaire
        return redirect()->route('page.index')->with('success', 'Ressource supprimée avec succès!');
    }
}

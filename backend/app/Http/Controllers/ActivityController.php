<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\activite;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexActivity()
    {
        $user = Auth::User();
        $role = $user->role;

   if ($role === 0){
       $offres = activite::all();
       return response()->json($offres);
   }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeActivity(Request $request)
    {
        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'objectif' => ['required', 'string','max:255'],
            'image_pub' => [ 'string', 'min:8'],
            'lien_youtube' => [ 'string', 'max:255'],
            'age_min' => [ 'string', 'max:255'],
            'age_max' => [ 'string', 'max:255'],
            'eff_min' => [ 'string', 'max:255'],
            'eff_max' => [ 'string', 'max:255'],
            'prix' => [ 'string', 'max:255'],
            'animateur_id' => [ 'string', 'max:255'],
            'admin_id' => [ 'string', 'max:255'],
            'type_id' => [ 'string', 'max:255'],
           

        ]);

        $activite= Activite::create($request->all());
    
        // Retournez une réponse JSON indiquant que l'offre a été créée avec succès
        return response()->json(['message' => 'Offre créée avec succès', 'offre' => $activite]);
    }

    /**
     * Display the specified resource.
     */
    public function showActivity(string $id)
    {
        $user = Auth::User();
        $role =$user->role;
       if ($role === 0) {
            $activite = Activite::findOrFail($id);
            return response()->json($activite );
       } else {
            return response()->json(['error' => 'Page not found'], 404);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateActivity(Request $request, string $id)
    {

        $request->validate([
            'titre' => ['string', 'max:255'],
            'description' => [ 'string', 'max:255'],
            'objectif' => [ 'string','max:255'],
            'image_pub' => [ 'string', 'min:8'],
            'lien_youtube' => [ 'string', 'max:255'],
            'age_min' => [ 'string', 'max:255'],
            'age_max' => [ 'string', 'max:255'],
            'eff_min' => [ 'string', 'max:255'],
            'eff_max' => [ 'string', 'max:255'],
            'prix' => [ 'string', 'max:255'],
            'animateur_id' => [ 'string', 'max:255'],
            'admin_id' => [ 'string', 'max:255'],
            'type_id' => [ 'string', 'max:255'],
           ]);
        
        $activite= Activite::findOrFail($id);
        $activite->update($request->all());
        return response()->json($activite, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyActivity(string $id)
    {
         // Trouvez la ressource à supprimer
         $ressource =Activite::findOrFail($id);

         // Supprimez la ressource
         $ressource->delete();
 
         // Redirigez vers une autre page ou effectuez toute autre action nécessaire
    }
}

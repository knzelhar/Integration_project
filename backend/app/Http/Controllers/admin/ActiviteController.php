<?php

namespace App\Http\controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\activite;
use Illuminate\Support\Facades\Auth;
use App\Models\type_activite;
use App\Models\horaire;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //  $user = Auth::User();
        //$role = $user->role;

   //if ($role === 0){

        $allactiite = activite::all();
      // $offres = activite::select('id','titre','objectif','image_pub')->get();
       return response()->json($allactiite);
   //}
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //     $user = Auth::User();
    //     $role =$user->role;
    //    if ($role === 0) {
            $activite = Activite::findOrFail($id);
            return response()->json($activite );
    //    } else {
    //         return response()->json(['error' => 'Page not found'], 404);
    //      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
    public function destroy(string $id)
    {
         // Trouvez la ressource à supprimer
         $ressource =Activite::findOrFail($id);

         // Supprimez la ressource
         $ressource->delete();
         return response()->json($ressource, 200);
    }
}

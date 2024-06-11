<?php

namespace App\Http\controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\activite;
use App\Models\admin_user;
use Illuminate\Support\Facades\Auth;
use App\Models\type_activite;
use App\Models\horaire;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    $user = Auth::User();
    //     $role = $user->role;

    // if ($role === 0){

        $activite = activite::all();
       return response()->json($activite);
    // }
    }

    /**
     * Stockage de l'activite
     */
    public function store(Request $request){
        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'descriptif' => ['required', 'string', 'max:255'],
            'objectif' => ['required', 'string', 'max:255'],
            'image_pub' => ['string', 'max:255'],
            'lien_youtube' => ['string', 'max:255'],
            'age_min' => ['integer', 'max:255'],
            'age_max' => ['integer', 'max:255'],
            'eff_min' => ['integer', 'max:255'],
            'eff_max' => ['integer', 'max:255'],
            'prix' => ['numeric', 'max:999999.99'],
            'type' => ['required', 'string'],
            'description_type' => ['required', 'string'],
        ]);

        //Creer une nouvelle instance de type_activite
        $type_activite=type_activite::create([
            'type' => $request->type,
            'description' =>$request->description_type
        ]);
        $type_activite->save();
        $adminId=admin_user::first();

        // Recuperer l'identifiant de type_activite cree
        $typeActiviteId= $type_activite->id;
        $activite=activite::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'descriptif' => $request->descriptif,
            'objectif' => $request->objectif,
            'image_pub' => $request->image_pub,
            'lien_youtube' => $request -> lien_youtube,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'eff_min' =>$request->eff_min,
            'eff_max' => $request->eff_max,
            'prix' => $request->prix,
            'type_id'=> $typeActiviteId,
            'animateur_id' => null,
            'admin_id' => $adminId->id,
        ]);
        $activite->save();
        $activiteId= $activite->id;
        $horaires=$request->input('horaires', []);
        foreach ($horaires as $horaireData){
            $this->createHoraire($horaireData, $activiteId);
        }
        return response()->json(['message'=>'Activite cree avec succes']);
    }

    /**
     * Creation de l'horaire concernant l'activite
     */

    public function createHoraire(array $horaireData, $activiteId){
        $validator=Validator::make($horaireData, [
            'jour_par_semaine' => ['required', 'string'],
            'debut' => ['required'],
            'fin' => ['required'],
        ]);
        if($validator->fails()){
            throw new ValidationException($validator);
        }
        $horaire=horaire::create($horaireData);
        DB::table('dispo_horaire_activites')->insert([
            'horaire_id' => $horaire->id,
            'activite_id' => $activiteId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
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

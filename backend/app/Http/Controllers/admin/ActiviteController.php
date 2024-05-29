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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'descriptif' => ['required', 'string', 'max:255'],
            'objectif' => ['required', 'string','max:255'],
            'image_pub' => [ 'string', 'min:8'],
            'lien_youtube' => [ 'string', 'max:255'],
            'age_min' => [ 'integer', 'max:255'],
            'age_max' => [ 'integer', 'max:255'],
            'eff_min' => [ 'integer', 'max:255'],
            'eff_max' => [ 'integer', 'max:255'],
            'prix' => ['numeric', 'max:999999.99'],
           // 'animateur_id' => ['nullable', 'integer'],
            // 'admin_id' => [ 'required', 'integer'],
            'type' => [ 'required', 'string'],
            'description_type' => [ 'required', 'string'],

        ]);
       // Crée une nouvelle instance de type_activite
        $type_activite = type_activite::create([
            'type' => $request->type,
            'description' => $request->description_type
        ]);
        // Sauvegarde la nouvelle instance de type_activite
        $type_activite->save();
        // Récupère l'identifiant de type_activite créé
        $typeActiviteId = $type_activite->id;
        $activite = Activite::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'descriptif' => $request->descriptif,
            'objectif' => $request->objectif,
            'image_pub' => $request->image_pub,
            'lien_youtube' => $request->lien_youtube,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'eff_min' => $request->eff_min,
            'eff_max' => $request->eff_max,
            'prix' => $request->prix,
            'animateur_id' => 1, //$request->animateur_id
            'admin_id' => 1,
            'type_id' => $typeActiviteId // Ajoute l'identifiant de type_activite à l'activité
        ]);

        $activite->save();
        $horaires = $request->input('horaires', []);
        foreach ($horaires as $horaireData) {
            $this->createHoraire($horaireData, $activite->id);
        }

        //Retournez une réponse JSON indiquant que l'offre a été créée avec succès
        return response()->json(['message' => 'Activite créée avec succès']);
    }

    public function createHoraire(array $horaireData, $activiteId)
{
    // Validate the horaire data
    $validator = Validator::make($horaireData, [
        'jour_par_semaine' => ['required', 'string'],
        'debut' => ['required'],
        'fin' => ['required'],
    ]);

    if ($validator->fails()) {
        throw new \Illuminate\Validation\ValidationException($validator);
    }

    // Create the horaire
    $horaire = Horaire::create($horaireData);

    // Link the horaire with the activite in the pivot table
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

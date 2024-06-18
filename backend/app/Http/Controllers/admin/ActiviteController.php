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
      Affichage de la liste des activites.
     */
    public function index()
    {
         $user = Auth::User();
        $role = $user->role;

        if ($role === 0){

        $activite = activite::all();
        return response()->json($activite);
        }
    }

    /**
      Affichage des details de l'activite.
    */

    public function show(string $id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0){
        // Chargez les relations nécessaires avec 'with'
        $activite = Activite::with(['horaires', 'type_activites', 'animateur_users.users', 'admin_users.users'])->findOrFail($id);

        // Vérifiez si les relations existent
        $type_activite = $activite->type_activites;
        $animateur = $activite->animateur_users;
        $animateur_user = $animateur ? $animateur->users : null;

        $admin = $activite->admin_users;
        $admin_user = $admin ? $admin->users : null;


        // Construisez la réponse
        $response = [
            'id' => $activite->id,
            'titre' => $activite->titre,
            'description' => $activite->description,
            'descriptif' => $activite->descriptif,
            'objectif' => $activite->objectif,
            'image_pub' => $activite->image_pub,
            'lien_youtube' => $activite->lien_youtube,
            'age_min' => $activite->age_min,
            'age_max' => $activite->age_max,
            'eff_min' => $activite->eff_min,
            'eff_max' => $activite->eff_max,
            'prix' => $activite->prix,
            'animateur' => $animateur_user ? [
                'id' => $animateur->id,
                'nom' => $animateur_user->nom,
                'prenom' => $animateur_user->prenom,
            ] : null,
           'admin' => $admin ? [
                'id' => $admin->id,
                'nom' => $admin_user->nom,
                'prenom' => $admin_user->prenom,
            ] : null,

            'type' => $type_activite ? [
                'id' => $type_activite->id,
                'type' => $type_activite->type,
                'description' => $type_activite->description,
            ] : null,
            'horaires' => $activite->horaires->map(function ($horaire) {
                return [
                    'id' => $horaire->id,
                    'jour_par_semaine' => $horaire->jour_par_semaine,
                    'debut' => $horaire->debut,
                    'fin' => $horaire->fin,
                ];
            })->toArray()
        ];

        return response()->json($response);
    }
    }

    /**
      Stockage de l'activite avec l'horaire et type activite correspondants.
     */

    public function store(Request $request)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0){

        $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'descriptif' => ['required', 'string', 'max:255'],
            'objectif' => ['required', 'string', 'max:255'],
            'image_pub' => ['string', 'min:8'],
            'lien_youtube' => ['string', 'max:255'],
            'age_min' => ['integer', 'max:255'],
            'age_max' => ['integer', 'max:255'],
            'eff_min' => ['integer', 'max:255'],
            'eff_max' => ['integer', 'max:255'],
            'prix' => ['numeric', 'max:999999.99'],
            'type' => ['required', 'string'],
            'description_type' => ['required', 'string'],

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
            'animateur_id' => null,
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
    }

    public function createHoraire(array $horaireData, $activiteId)
    {
        // Validate the horaire data
        Validator::make($horaireData, [
            'jour_par_semaine' => ['required', 'string'],
            'debut' => ['required'],
            'fin' => ['required'],
        ])->validate();

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
      Modification de l'activite, l'horaire et type activite correspondants.
    */

    public function update(Request $request, string $id)
{
    $user = Auth::User();
    $role = $user->role;

    if ($role === 0){

    $request->validate([
        'titre' => ['string', 'max:255'],
        'description' => ['string', 'max:255'],
        'objectif' => ['string', 'max:255'],
        'image_pub' => ['string', 'min:8'],
        'lien_youtube' => ['string', 'max:255'],
        'age_min' => ['string', 'max:255'],
        'age_max' => ['string', 'max:255'],
        'eff_min' => ['string', 'max:255'],
        'eff_max' => ['string', 'max:255'],
        'prix' => ['string', 'max:255'],
        'type' => ['string'],
        'description_type' => ['string'],
        'horaires' => ['array'],
    ]);

    // Récupérer l'activité existante
    $activite = Activite::findOrFail($id);

    // Mettre à jour les champs de l'activité principale
    $activite->update($request->only([
        'titre', 'description', 'objectif', 'image_pub', 'lien_youtube',
        'age_min', 'age_max', 'eff_min', 'eff_max', 'prix'
    ]));

    // Mise à jour du type d'activité si nécessaire
        $activite->type_activites()->first()->update([
            'type' =>$request->type,
            'description' => $request->description_type,
        ]);

    // Mise à jour des horaires de l'activité
    if ($request->has('horaires')) {
        foreach ($request->horaires as $horaireData) {
                $horaire = Horaire::findOrFail($horaireData['id']);
                $horaire->update([
                    'jour_par_semaine' => $horaireData['jour_par_semaine'],
                    'debut' => $horaireData['debut'],
                    'fin' => $horaireData['fin'],
                ]);
        }
    }

    // Sauvegarde toutes les modifications
    $activite->save();

    // Retourne une réponse JSON indiquant que l'activité a été mise à jour avec succès
    return response()->json(['message' => 'Activité mise à jour avec succès']);
}
}


    /**
      Suppression de l'activite
    */

    public function destroy(string $id)
{
    $user = Auth::User();
    $role = $user->role;

    if ($role === 0){

    $activite = Activite::findOrFail($id);

    // Supprimez les horaires associés à l'activité
    $activite->horaires()->delete();

    // Supprimez l'activité elle-même
    $activite->delete();

    // Supprimez le type d'activité associé s'il existe
        $activite->type_activites()->delete();

    // Retournez une réponse JSON indiquant que l'activité a été supprimée avec succès
    return response()->json(['message' => 'Activité supprimée avec succès']);
    }
}

}

<?php

namespace App\Http\Controllers\animateur;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Animateur_user;
use App\Models\User;
use App\Models\Enfant;
use App\Models\Horaire;
use App\Models\Enfant_demande_activite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EspaceanimateurController extends Controller
{

    public function activite_animer($id)
    {

        // if ($user = Auth::User()) {
            $activiteanimer = activite::select('id', 'description', 'image_pub', 'lien_youtube')
                ->where('animateur_id', '=', $id)
                ->get();
            return response()->json($activiteanimer);
        // } else {
        //     return response()->json("Unauthorized or not found ");
        // }
    }

    public function allinformation($id)
    {
        // if($user = Auth::User()){
        // Sélectionner l'animateur ID et l'admin ID de l'activité
        $animateurIDinactivite = Activite::where('id', $id)->value('animateur_id');
        //    $adminIDinactivite = Activite::where('id', $idA)->value('admin_id');

        // Sélectionner les user ID correspondant à l'animateur et l'admin
        $user_id_animateur = animateur_user::where('id', $animateurIDinactivite)->value('user_id');
        //    $user_id_admin = admin_user::where('id', $adminIDinactivite)->value('user_id');

        // Sélectionner les noms de l'animateur et l'admin
        $nomanimateur = User::where('id', $user_id_animateur)->value('nom');
        //    $nomadmin = User::where('id', $user_id_admin)->value('nom');

        // Sélectionner toutes les informations de l'activité
        $allinfo = Activite::with('type_activites') // Charger la relation type_activites
            ->select('id', 'titre', 'objectif', 'image_pub', 'lien_youtube', 'descriptif', 'age_min', 'age_max', 'eff_min', 'eff_max', 'type_id')
            ->where('animateur_id', $id)
            ->first();

        $typeActivite = $allinfo->type_activites ? $allinfo->type_activites->type : null;


        $liste = [
            'nomanimateur' => $nomanimateur,
            //    'nomadmin' => $nomadmin,
            'activites' => $allinfo,
            'type_activite' => $typeActivite
        ];

        return response()->json($liste);
        // }else{
        // return response()->json("Unauthorized or not found ");
        // }
    }


    // liste des enfant :
    public function listeenfant($idA)
    {

        $enfantID = enfant_demande_activite::where('activite_id', $idA)->value('id');
        $enfantnom = enfant::select('nom', 'prenom')->where('id', '=',  $enfantID);


        $liste = [
            'enfantID' => $enfantID,
            'enfantnom' => $enfantnom

        ];
        return response()->json($liste);
    }

    public function enfantid($idE)
    {


        $enfant = enfant::select('*')->where('id', '=',  $idE)->get();
        return response()->json($enfant);
    }


    public function profile()
    {
        $user = Auth::User();
        $userid = $user->id;

        if ($user) {

            $animateurID = animateur_user::where('id',  $userid)->value('user_id');

            $animateurinfo = User::select('nom', 'prenom', 'email')->where('id', '=', $animateurID)->get();
            return response()->json($animateurinfo);
        }
    }

    public function afficherActivites($animateurId)
    {
        $activites = Activite::where('animateur_id', $animateurId)->select('titre')->get();
        return response()->json($activites);
    }

    public function afficherHorairesActivite($activiteId)
    {
        // Trouver l'activité avec les horaires associés
        $activite = Activite::with('horaires')->findOrFail($activiteId);

        // Préparer la réponse avec les détails de l'activité et les horaires disponibles
        return response()->json([
            'titre' => $activite->titre,
            'horaires' => $activite->horaires->select('id', 'jour_par_semaine', 'debut', 'fin')
        ]);
    }


    public function enregistrerHorairesSelectionnes(Request $request, $activiteId, $animateurId)
    {
        // Valider les données de la requête
        $request->validate([
            'horaires_selectionnes' => 'required|array',
            'horaires_selectionnes.*' => 'integer',
        ]);

        // Récupérer les horaires sélectionnés
        $horairesSelectionnes = $request->input('horaires_selectionnes');

        // Enregistrer les horaires sélectionnés avec l'animateur dans la table dispo_horaire_animateurs
        foreach ($horairesSelectionnes as $horaireId) {
            // Vérifier si l'horaire appartient bien à l'activité spécifiée
            $horaire = Horaire::where('id', $horaireId)
                ->whereHas('activites', function ($query) use ($activiteId) {
                    $query->where('id', $activiteId);
                })
                ->firstOrFail();

            // Enregistrer l'horaire avec l'animateur
            DB::table('dispo_horaire_animateurs')->insert([
                'horaire_id' => $horaireId,
                'animateur_id' => $animateurId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Répondre avec un message de succès
        return response()->json(['message' => 'Horaires sélectionnés enregistrés avec succès']);
    }
}

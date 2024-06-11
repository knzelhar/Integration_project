<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\offre_option_activite;
use App\Models\offre;
use App\Models\activite;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\requestoffre;
use App\Models\enfant_paiement;
use App\Models\option_paiement;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
// use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\request; 



class OffreController extends Controller
{
    public function afficher($id)
    {
        $response =Offre::findOrFail($id);
        return response()->json($response);
    }
    public function index()
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0){

        // Récupérer toutes les offres avec la relation activiteOffres chargée
        //$offres = Offre::with('activiteOffres')->get();
        $response =Offre::all();
        // Construire la réponse JSON en incluant le titre de chaque activité pour chaque offre
        // $response = $offres->map(function ($offre) {
        //     return [
        //         'titre' => $offre->titre,
        //         'description' => $offre->description,
        //         'date_creation' => $offre->date_creation,
        //         'date_mise_a_jour' => $offre->date_mise_a_jour,
        //         'volume_horaire' => $offre->volume_horaire,
        //         'message_pub' => $offre->message_pub,
        //         'remise' => $offre->remise,
        //         //'activites' => $offre->activiteOffres->pluck('titre')
        //     ];
        // });

        return response()->json($response);
        }
    }

    // Fonction pour afficher les activités
    private function showActivities()
    {
        // Récupérer les activités
        $activites = Activite::pluck('titre')->toArray();

        // Retourner les activités (ne renvoyez pas de réponse JSON ici)
        return $activites;
    }

    public function store(requestoffre $request)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0){
        // Validation des données de la requête
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'date_creation' => 'required',
            // 'date_mise_a_jour' => 'date_format:d/m/Y',
            'date_debut_insc' => 'nullable|string',
            'date_fin_insc' => 'nullable|string',
            'volume_horaire' => 'required|numeric',
            'message_pub' => 'required|string',
            'remise' => 'required|numeric',
            // 'activite_titres' => 'required|exists:activites,titre',
            // 'nbr_seances_sem' => 'required|integer',
            // 'duree' => 'required|numeric',
        ]);

        // Supprimer l'attribut activite_id des données validées
        // unset($validatedData['activite_titres']);
        // unset($validatedData['nbr_hseances_sem']);
        // unset($validatedData['duree']);

        // Créer une nouvelle offre
        $offre = Offre::create($validatedData);

        // Appel de la fonction showActivities à l'intérieur de la fonction index
        // $activites = $this->showActivities();

        // Récupérer les IDs des activités sélectionnées depuis la requête
        // $activiteTitres = $request->input('activite_titres');

        // Vérifier si les titres des activités sont valides et récupérer leurs IDs
        // $activiteIds = [];
        // foreach ($activiteTitres as $titre) {
        //     $activite = Activite::where('titre', $titre)->first();
        //     if (!$activite) {
        //         // Si aucune activité correspondante n'est trouvée dans la base de données
        //         return response()->json(['error' => 'Titre d\'activité invalide : ' . $titre], 400);
        //     }
        //     $activiteIds[] = $activite->id;
        // }

        //  $activiteId = $request->input('activite_id');

        // foreach ($activiteIds as $activiteId) {
        //     // Insérer une nouvelle ligne dans la table offre_option_activite
        //     DB::table('offre_option_activites')->insert([
        //         'offre_id' => $offre->id,
        //         'activite_id' => $activiteId,
        //         'option_pay_id' => null, // vous pouvez ajuster ceci selon vos besoins
        //         'nbr_seances_sem' => $request->input('nbr_seances_sem'),
        //         'duree' => $request->input('duree'),
        //         // Si nécessaire, vous pouvez également définir d'autres champs de la table ici
        //     ]);
        // }

        // Retourner une réponse JSON avec les données de l'offre créée
        return response()->json(['message' => 'Offre créée avec succès', 'offre' => $offre]);
    }
    }


    // Affichage d'une offre selon l'id


    public function show(string $id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0){
        // Récupérer l'offre avec la relation activiteOffres chargée
        $offre = Offre::with('activiteOffres')->findOrFail($id);

        // Récupérer les activités associées à l'offre
        $activitesAssociees = DB::table('offre_option_activites')
            ->join('activites', 'offre_option_activites.activite_id', '=', 'activites.id')
            ->where('offre_option_activites.offre_id', $id)
            ->pluck('activites.titre');

        // Construire la réponse JSON en incluant les informations de l'offre et les activités associées
        $response = [
            'offre' => [
                'titre' => $offre->titre,
                'description' => $offre->description,
                'volume_horaire' => $offre->volume_horaire,
                'message_pub' => $offre->message_pub,
                'remise' => $offre->remise,
                'activites_associees' => $activitesAssociees, // Inclure les activités associées à l'offre
            ]
        ];

        // Retourner la réponse JSON
        return response()->json($response);
    }
    }



    // Update the specified resource in storage.


    //Remove the specified resource from storage.

    public function destroyOffre(string $id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0){
        offre::findOrFail($id)->delete();
        return response()->json(['message' => 'Offre supprimee avec succes'], 200);
        }
    }

    public function remisepaiement(string $designation)
    {
        // Initialiser la variable de remise
        $remise = 0;

        // Utiliser une structure de contrôle switch pour traiter chaque cas de désignation
        switch ($designation) {
            case 'mois':
                $remise = 0;
                break;
            case 'trimestre':
                $remise = 10;
                break;
            case 'semestre':
                $remise = 15;
                break;
            case 'annuel':
                $remise = 20;
                break;
            default:
                // Si la désignation n'est pas reconnue, laisser la remise à 0
                break;
        }

        // Retourner la valeur de remise calculée
        return $remise;
    }



    // option paiment

    public function option_paiement(requestoffre $req, $id_Offre, $id_activite, $id_enfant)
    {

        // $user = Auth::User();

        // Validation des données de la requête
        $validatedData = $req->validate([
            'designation' => 'required|string',
            // 'remise' => 'required|decimal',
            'methode_pay' => 'required|decimal'
        ]);

        // Initialiser la variable de remise
        $remise = 0;
        $designation=$validatedData['designation'];
        // Utiliser une structure de contrôle switch pour traiter chaque cas de désignation
        switch ($designation) {
            case 'mois':
                $remise = 0;
                break;
            case 'trimestre':
                $remise = 10;
                break;
            case 'semestre':
                $remise = 15;
                break;
            case 'annuel':
                $remise = 20;
                break;
            default:
                break;
        }

        $optionPaiment = new option_paiement();
        $optionPaiment->designation = $req->designation;
        $optionPaiment->remise = $remise;
        $optionPaiment->methode_pay = $req->methode_pay;
        $optionPaiment->save();



        $offre_option_activite = offre_option_activite::find($id_Offre);
        if ($offre_option_activite->activite_id === $id_activite) {
            $offr = offre_option_activite::table('offre_option_activites')->update([
                'option_pay_id' => $optionPaiment->id,
            ]);
            $offr->save();
        } else {
            return;
        }



        $enfant_paiement = new enfant_paiement();
        $enfant_paiement->enfant_id = $id_enfant;
        $enfant_paiement->paiement_id = $optionPaiment->id;
        $enfant_paiement->save();

        return response()->json($enfant_paiement, 200);
    }
}

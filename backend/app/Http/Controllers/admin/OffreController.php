<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\offre_option_activite;
use App\Models\offre;
use App\Models\activite;
use Illuminate\Support\Facades\Auth;
use App\Models\option_paiement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class OffreController extends Controller
{
    /**
     ? Affichage de l'offre
     */

    public function index()
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0) {
            $response = Offre::all();

            return response()->json($response);
        }
    }

    /**
     ? Affichage des details de l'offre
     */

     public function show(string $id)
     {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 0) {
        $activiteIds = Offre_option_activite::where('offre_id', $id)
                                    ->select('activite_id')
                                    ->distinct()
                                    ->get();

        $paiementIds = Offre_option_activite::where('offre_id', $id)
                                    ->select('option_pay_id')
                                    ->distinct()
                                    ->get();
        $response = [
            'offre' => Offre::find($id),
            'activites' => Activite::whereIn('id', $activiteIds)->get(),
            'options_paiement' => option_paiement::whereIn('id', $paiementIds)->get(),
            ];
            return response()->json($response);
        }
     }


    /**
     ? Fonction pour créer une nouvelle offre
     */

    public function store(Request $request)
    {
        // $user = Auth::User();
        // $role = $user->role;
        // if ($role === 0) {
            $offreValidatedData = $request->validate([
                'titre' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'date_creation' => ['required', 'string', 'max:255'],
                'date_mise_a_jour' => ['nullable', 'string', 'max:255'],
                'volume_horaire' => ['numeric', 'max:999999.99'],
                'message_pub' => ['required', 'string', 'max:255'],
                'remise' => ['numeric', 'max:999999.99'],
            ]);

            // Créer une nouvelle offre
            $offre = offre::create($offreValidatedData);

            // Validation des données des activités
            $activitesValidatedData = $request->validate([
                'activite_ids' => 'required|array',
                'activite_ids.*' => 'exists:activites,id',
                'nbr_sceances_sem' => 'required|integer',
                'duree' => 'required|numeric',
            ]);

            // Récupérer les IDs des activités depuis la requête
            $activiteIds = $activitesValidatedData['activite_ids'];

            // Récupérer les options de paiement depuis la requête
            $optionsPaiement = $request->input('option_paiement', []);
            $optionPaiements = $this->createOptionPaiement($optionsPaiement);

            // Insérer les activités sélectionnées et leurs options de paiement dans la table pivot
            foreach ($activiteIds as $activiteId) {
                foreach ($optionPaiements as $optionData) {

                    DB::table('offre_option_activites')->insert([
                        'offre_id' => $offre->id,
                        'activite_id' => $activiteId,
                        'demande_id' => null,
                        'option_pay_id' => $optionData->id,
                        'nbr_sceances_sem' => $activitesValidatedData['nbr_sceances_sem'],
                        'duree' => $activitesValidatedData['duree'],
                    ]);
                }
            }

            return response()->json(['message' => 'Offre créée avec succès', 'offre' => $offre]);
        // }
    }

    public function createOptionPaiement(array $optionsPaiement)
    {
        $createdOptions = [];

        foreach ($optionsPaiement as $optionPaiement) {
            Validator::make($optionPaiement, [
                'designation' => 'required|string',
                'method_pay' => 'required|string',
                'remise' => 'required|numeric',
            ])->validate();

            $createdOption = option_paiement::create($optionPaiement);
            $createdOptions[] = $createdOption;
        }

        return $createdOptions;
    }

    /**
     ? Mise a jour de l'offre avec ses options paiements
     */

    public function update(Request $request, $id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $validated = $request->validate([
                'offre' => 'required|array',
                'offre.titre' => 'required|string',
                'offre.description' => 'required|string',
                'offre.date_creation' => 'required|string',
                'offre.date_mise_a_jour' => 'nullable|string',
                'offre.volume_horaire' => 'required|numeric',
                'offre.message_pub' => 'required|string',
                'offre.remise' => 'required|numeric',

                'option_paiement' => 'required|array',
                'option_paiement.*.id' => 'required|integer|exists:option_paiements,id',
                'option_paiement.*.designation' => 'required|string',
                'option_paiement.*.method_pay' => 'required|string',
                'option_paiement.*.remise' => 'required|numeric',

                'offre_option_activites' => 'required|array',
                'offre_option_activites.*.activite_id' => 'required|integer|exists:activites,id',
                'offre_option_activites.*.tarif' => 'required|numeric',
                'offre_option_activites.*.nbr_sceances_sem' => 'required|integer',
                'offre_option_activites.*.duree' => 'required|numeric',
            ]);

            // Mise à jour de l'offre
            $offre = Offre::findOrFail($id);
            $offre->update($validated['offre']);

            // Mise à jour des options de paiement associées
            foreach ($validated['option_paiement'] as $optionPayData) {
                $optionPaiement = option_paiement::findOrFail($optionPayData['id']);
                $optionPaiement->update($optionPayData);
            }

            // Mise à jour des relations dans la table pivot offre_option_activites
            foreach ($validated['offre_option_activites'] as $offreOptionActiviteData) {
                $offreOptionActivite = offre_option_activite::where('offre_id', $id)
                    ->where('activite_id', $offreOptionActiviteData['activite_id'])
                    ->firstOrFail();

                $offreOptionActivite->update($offreOptionActiviteData);
            }

            return response()->json([
                'message' => 'Les informations ont été mises à jour avec succès.',
                'offre' => $offre,
            ], 200);
        }
    }

    /**
 ? Suppresion de l'offre avec ses options paiements
     */

    public function destroy($id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $offre = Offre::findOrFail($id);
            $optionPaiements = option_paiement::all();
            $offre->delete();

            foreach ($optionPaiements as $optionPaiement) {
                $optionPaiement->delete();
            }

            return response()->json([
                'message' => 'L\'offre et ses options de paiement associées ont été supprimées avec succès.'
            ], 200);
        }
    }
}

<?php

namespace App\Http\Controllers\parent;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use App\Models\Activite;
use App\Models\dispo_horaire_animateur;
use App\Models\Horaire;
use App\Models\Enfant;
use App\Models\Offre_option_activite;
use App\Models\option_paiement;
use App\Models\dispo_horaire_activite;
use App\Models\enfant_demande_activite;
use App\Models\groupe;
use App\Models\pack;
use App\Models\demande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InscriptionoffreController extends Controller
{

    /**
     Affichage d'un seul enfant
     */

    public function showEnfant($id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $enfant = Enfant::find($id);
            return response()->json($enfant);
        }
    }

    /**
     Affichage d'une seule offre
     */

    public function showOffre($id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $offre = Offre::find($id);
            return response()->json($offre);
        }
    }

    /**
      Affichage des offres
     */

    public function indexOffre()
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $offres = Offre::all();
            return response()->json($offres);
        }
    }

    /**
     Affichage d'une seule activite
     */

    public function showActivite($id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $activite = Activite::with(['type_activites', 'animateur_users.users'])->findOrFail($id);

            // Vérifiez si les relations existent
            $type_activite = $activite->type_activites;
            $animateur = $activite->animateur_users;
            $animateur_user = $animateur ? $animateur->users : null;

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
                'type' => $type_activite ? [
                    'id' => $type_activite->id,
                    'type' => $type_activite->type,
                    'description' => $type_activite->description,
                ] : null
            ];

            return response()->json($response);
        }
    }

    /**
     Affichages des activites de l'offre
     */

    public function indexActivites($id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $activiteIds = Offre_option_activite::where('offre_id', $id)
                ->select('activite_id')
                ->distinct()
                ->get();

            $activites = Activite::whereIn('id', $activiteIds)->get();

            return response()->json($activites);
        }
    }

    /**
     Affichages des option_paiements de l'offre
     */

    public function indexpaiements($id)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $paimentIds = Offre_option_activite::where('offre_id', $id)
                ->select('option_pay_id')
                ->distinct()
                ->get();

            $paiements = Option_paiement::whereIn('id', $paimentIds)->get();

            return response()->json($paiements);
        }
    }

    /**
     Affichages des disponibilites de l'activite
     */

    public function Disponibilites($activiteId)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $activite = Activite::findOrFail($activiteId);
            $horaireIds = dispo_horaire_activite::where('activite_id', $activiteId)
                ->select('horaire_id')
                ->get();

            $animateurId = Activite::select('animateur_id')->findOrFail($activiteId)->animateur_id;
            $dispoIds = dispo_horaire_animateur::where('animateur_id', $animateurId)
                ->whereIn('horaire_id', $horaireIds)
                ->select('horaire_id')
                ->get();
            $horaire = Horaire::whereIn('id', $dispoIds)->get();

            return response()->json([
                'titre' => $activite->titre,
                'horaires' => $horaire
            ]);
        }
    }

    /**
     Stockage des horaires convenable pour l'enfant
     */

    protected function storeDispo($dispoIds, $enfantId, $activiteId)
    {
        $data = [];
        foreach ($dispoIds as $dispoId) {
            $data[] = [
                'horaire_id' => $dispoId,
                'enfant_id' => $enfantId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $nbrActivite = enfant_demande_activite::where('activite_id', $activiteId)->count('activite_id');
        $effMax = Activite::select('eff_max')->findOrFail($activiteId)->eff_max;

        if ($nbrActivite < $effMax) {
            if (!empty($data)) {
                DB::table('dispo_horaire_enfants')->insert($data);
                foreach ($data as $horaire) {
                    $horaireId = $horaire['horaire_id'];
                    $enfantId = $horaire['enfant_id'];
                    $groupe = groupe::create([
                        'enfant_id' => $enfantId,
                        'activite_id' => $activiteId,
                        'horaire_id' => $horaireId,
                    ]);
                    $groupe->save();
                }
            }

            return response()->json(['message' => 'Horaires enregistrés avec succès']);
        } else {
            return response()->json(['message' => 'Activité saturée']);
        }
    }

    protected function determinePack($nombreActivites, $nombreEnfants)
    {

        $packnbrEanfant = Pack::where('type', 'pack_nbr_enf')->value('nbr_enfant');
        $packnbrActivite = Pack::where('type', 'pack_atelier')->value('nbr_atelier');

        if ($nombreEnfants >= $packnbrEanfant && $nombreActivites < $packnbrActivite) {
            return 1;
        }
        if ($nombreActivites >= $packnbrActivite && $nombreEnfants < $packnbrEanfant) {
            return 2;
        }

        if ($nombreEnfants >= $packnbrEanfant && $nombreActivites >= $packnbrActivite) {
            return 0;
        }

        if ($nombreEnfants < $packnbrEanfant && $nombreActivites < $packnbrActivite) {
            return 3;
        }
    }


    /**
     Afficher tous les Packs disponibles
     */

    public function indexPacks()
    {
        $packs = pack::all();
        return response()->json($packs);
    }

    /**
     Creation de la demande
     */


    public function createDemande(Request $request)
    {
        // $user = Auth::User();
        // $role = $user->role;
        // $parentId = $user->parent_users->id;

        // if ($role === 2) {
            $data = $request->validate([
                'offre_id' => 'required|integer',
                'activites' => 'required|array',
                'activites.*.activite_id' => 'required|integer',
                'activites.*.enfants' => 'required|array',
                'activites.*.enfants.*.enfant_id' => 'required|integer',
                'activites.*.enfants.*.paiement_id' => 'required|array',
                'activites.*.enfants.*.paiement_id.*' => 'required|integer',
                'activites.*.enfants.*.disponibilites' => 'required|array',
                'activites.*.enfants.*.dispo_id.*' => 'required|integer',
            ]);

            $nombreActivites = count($data['activites']);

            // Utiliser un tableau pour stocker les IDs uniques des enfants
            $uniqueEnfantIds = [];

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    $uniqueEnfantIds[] = $enfant['enfant_id'];
                }
            }

            $uniqueEnfantIds = array_unique($uniqueEnfantIds);

            $nombreEnfants = count($uniqueEnfantIds);

            $packType = $this->determinePack($nombreActivites, $nombreEnfants);

            // if ($packType == 0) {
            //     return redirect()->route('inscription_pack');
            // }

            // Récupérer l'ID du pack en fonction du type
            $packId = null;
            if ($packType == 1) {
                $packId = Pack::where('type', 'pack_nbr_enf')->value('id');
            } elseif ($packType == 2) {
                $packId = Pack::where('type', 'pack_atelier')->value('id');
            } elseif ($packType == 3) {
                $packId = null;
            }

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    $dispoIds = $enfant['disponibilites'];
                    $this->storeDispo($dispoIds, $enfant['enfant_id'], $activite['activite_id']);
                }
            }

            $demande = new Demande([
                'parent_id' =>1,// $parentId,
                'pack_id' => $packId,
                'admin_id' => null,
                'date_dem' => now(),
                'statut_dem' => 'en cours',
                'statut_admin' => 'non traitée',
                'motif_refus_parent' => null,
                'date_traitement' => null,
                'motif_refus_admin' => null,
            ]);

            $demande->save();
            $demandeId = $demande->id;

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    $inscription_enf = enfant_demande_activite::create([
                        'demande_id' => $demandeId,
                        'activite_id' => $activite['activite_id'],
                        'enfant_id' => $enfant['enfant_id'],
                    ]);
                    $inscription_enf->save();
                }
            }

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    foreach ($enfant['paiement_id'] as $paiement) {
                        $offre = $request->input('offre_id');
                        $donnees = Offre_option_activite::where('offre_id', $offre)
                            ->where('activite_id', $activite['activite_id'])
                            ->where('option_pay_id', $paiement)
                            ->select('nbr_sceances_sem', 'tarif', 'duree')
                            ->first();

                        $inscription = Offre_option_activite::create([
                            'demande_id' => $demandeId,
                            'activite_id' => $activite['activite_id'],
                            'option_pay_id' => $paiement,
                            'offre_id' => $offre,
                            'nbr_sceances_sem' => $donnees->nbr_sceances_sem,
                            'tarif' => $donnees->tarif,
                            'duree' => $donnees->duree,
                        ]);
                        $inscription->save();
                    }
                }
            }

            return response()->json(['message' => 'Inscription faite avec succès']);
        // }
    }

    /**
     Creation de la demande apres choisir le type de pack
     */

    public function demandeAfterPack(Request $request)
    {
        $user = Auth::User();
        $role = $user->role;
        $parentId = $user->parent_users->id;

        if ($role === 2) {
            $data = $request->validate([
                'offre_id' => 'required|integer',
                'pack_id' => 'required|integer',
                'activites' => 'required|array',
                'activites.*.activite_id' => 'required|integer',
                'activites.*.enfants' => 'required|array',
                'activites.*.enfants.*.enfant_id' => 'required|integer',
                'activites.*.enfants.*.paiement_id' => 'required|array',
                'activites.*.enfants.*.paiement_id.*' => 'required|integer',
                'activites.*.enfants.*.disponibilites' => 'required|array',
                'activites.*.enfants.*.dispo_id.*' => 'required|integer',
            ]);

            $packId = $data['pack_id'];

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    $dispoIds = $enfant['disponibilites'];
                    $this->storeDispo($dispoIds, $enfant['enfant_id'], $activite['activite_id']);
                }
            }

            $demande = new Demande([
                'parent_id' => $parentId,
                'pack_id' => $packId,
                'admin_id' => null,
                'date_dem' => now(),
                'statut_dem' => 'en cours',
                'statut_admin' => 'non traitée',
                'motif_refus_parent' => null,
                'date_traitement' => null,
                'motif_refus_admin' => null,
            ]);

            $demande->save();
            $demandeId = $demande->id;

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    $inscription_enf = enfant_demande_activite::create([
                        'demande_id' => $demandeId,
                        'activite_id' => $activite['activite_id'],
                        'enfant_id' => $enfant['enfant_id'],
                    ]);
                    $inscription_enf->save();
                }
            }

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    foreach ($enfant['paiement_id'] as $paiement) {
                        $offre = $request->input('offre_id');
                        $donnees = Offre_option_activite::where('offre_id', $offre)
                            ->where('activite_id', $activite['activite_id'])
                            ->where('option_pay_id', $paiement)
                            ->select('nbr_sceances_sem', 'tarif', 'duree')
                            ->first();

                        $inscription = Offre_option_activite::create([
                            'demande_id' => $demandeId,
                            'activite_id' => $activite['activite_id'],
                            'option_pay_id' => $paiement,
                            'offre_id' => $offre,
                            'nbr_sceances_sem' => $donnees->nbr_sceances_sem,
                            'tarif' => $donnees->tarif,
                            'duree' => $donnees->duree,
                        ]);
                        $inscription->save();
                    }
                }
            }

            return response()->json(['message' => 'Inscription faite avec succès']);
        }
    }

    public function determine(Request $request)
    {
        $user = Auth::User();
        $role = $user->role;

        if ($role === 2) {
            $data = $request->validate([
                'offre_id' => 'required|integer',
                'activites' => 'required|array',
                'activites.*.activite_id' => 'required|integer',
                'activites.*.enfants' => 'required|array',
                'activites.*.enfants.*.enfant_id' => 'required|integer',
                'activites.*.enfants.*.paiement_id' => 'required|array',
                'activites.*.enfants.*.paiement_id.*' => 'required|integer',
                'activites.*.enfants.*.disponibilites' => 'required|array',
                'activites.*.enfants.*.dispo_id.*' => 'required|integer',
            ]);

            $nombreActivites = count($data['activites']);

            // Utiliser un tableau pour stocker les IDs uniques des enfants
            $uniqueEnfantIds = [];

            foreach ($data['activites'] as $activite) {
                foreach ($activite['enfants'] as $enfant) {
                    $uniqueEnfantIds[] = $enfant['enfant_id'];
                }
            }

            $uniqueEnfantIds = array_unique($uniqueEnfantIds);

            $nombreEnfants = count($uniqueEnfantIds);

            $packType = $this->determinePack($nombreActivites, $nombreEnfants);


            return response()->json($packType);
        }
    }
}

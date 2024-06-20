<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\offre;
use App\Models\demande;
use App\Models\Activite;
use App\Models\Enfant;
use App\Models\offre_option_activite;
use Illuminate\Http\Request;


class DemandeController extends Controller
{

    /**
     Afficher Toutes les demandes (non traitées ,acceptées et refusées ...)
     */

    public function demandes()
    {
        // $user = Auth::User();
        // $role = $user->role;
        // if ($role === 0) {

        $demandes = demande::with(['parent_users', 'packs'])
        ->get();
        $result = [];
        foreach ($demandes as $demande) {
            $parentUser = $demande->parent_users;
            $parentNom = $parentUser->users->nom . ' ' . $parentUser->users->prenom;
            $data = [
                'date_dem' => $demande->date_dem,
                'statut_dem' => $demande->statut_dem,
                'statut_admin' => $demande->statut_admin,
                'motif_refus_parent' => $demande->motif_refus_parent,
                'date_traitement' => $demande->date_traitement,
                'motif_refus_admin' => $demande->motif_refus_admin,
                'pack' => $demande->packs ? $demande->packs->pluck('type') : null,
                'parent_name' => $parentNom,
            ];
            $result[] = $data;
        }

        return response()->json($result);
        // }
    }

    /**
     Afficher les nouvelles demandes(non traitées)
     */

    public function demandesAtraiter()
    {
        // $user = Auth::User();
        // $role = $user->role;
        // if ($role === 0) {
            $demandes = demande::with(['parent_users', 'packs', 'devis', 'devis.facture'])
                ->where('statut_admin', 'non traitée')
                ->get();
            $result = [];
            foreach ($demandes as $demande) {
                $parentUser = $demande->parent_users;
                $parentNom = $parentUser->users->nom . ' ' . $parentUser->users->prenom;
                $data = [
                    'date_dem' => $demande->date_dem,
                    'statut_dem' => $demande->statut_dem,
                    'statut_admin' => $demande->statut_admin,
                    'motif_refus_parent' => $demande->motif_refus_parent,
                    'date_traitement' => $demande->date_traitement,
                    'motif_refus_admin' => $demande->motif_refus_admin,
                    'message_pub' => $demande->message_pub,
                    'remise' => $demande->remise,
                    'pack' => $demande->packs ? $demande->packs->pluck('type') : null,
                    'parent_name' => $parentNom,
                ];
                $result[] = $data;
            }

            return response()->json($result);
        // }
    }

    /**
     Afficher une seule demande
     */

    public function show($id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $demande = demande::with(['parent_users', 'packs', 'devis', 'devis.facture'])
                ->findOrFail($id);

            $parentUser = $demande->parent_users;
            $parentNom = $parentUser->users->nom . ' ' . $parentUser->users->prenom;

            $data = [
                'date_dem' => $demande->date_dem,
                'statut_dem' => $demande->statut_dem,
                'statut_admin' => $demande->statut_admin,
                'motif_refus_parent' => $demande->motif_refus_parent,
                'date_traitement' => $demande->date_traitement,
                'motif_refus_admin' => $demande->motif_refus_admin,
                'message_pub' => $demande->message_pub,
                'remise' => $demande->remise,
                'pack' => $demande->packs ? $demande->packs->pluck('type') : null,
                'parent_name' => $parentNom,
            ];
            return response()->json($data);
        }
    }

    /**
     Afficher les  demandes acceptées par l'admin
     */

    public function demandeAcceptees()
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $demandes = demande::with(['parent_users', 'packs', 'devis', 'devis.facture'])
                ->where('statut_admin', 'acceptée')
                ->get();
            $result = [];
            foreach ($demandes as $demande) {
                $parentUser = $demande->parent_users;
                $parentNom = $parentUser->users->nom . ' ' . $parentUser->users->prenom;
                $data = [
                    'date_dem' => $demande->date_dem,
                    'statut_dem' => $demande->statut_dem,
                    'statut_admin' => $demande->statut_admin,
                    'motif_refus_parent' => $demande->motif_refus_parent,
                    'date_traitement' => $demande->date_traitement,
                    'motif_refus_admin' => $demande->motif_refus_admin,
                    'message_pub' => $demande->message_pub,
                    'remise' => $demande->remise,
                    'pack' => $demande->packs ? $demande->packs->pluck('type') : null,
                    'parent_name' => $parentNom,
                ];
                $result[] = $data;
            }

            return response()->json($result);
        }
    }


    /**
     Afficher les  demandes refusées par l'admin
     */

    public function demandeRefusees()
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $demandes = demande::with(['parent_users', 'packs', 'devis', 'devis.facture'])
                ->where('statut_admin', 'refusée')
                ->get();
            $result = [];
            foreach ($demandes as $demande) {
                $parentUser = $demande->parent_users;
                $parentNom = $parentUser->users->nom . ' ' . $parentUser->users->prenom;
                $data = [
                    'date_dem' => $demande->date_dem,
                    'statut_dem' => $demande->statut_dem,
                    'statut_admin' => $demande->statut_admin,
                    'motif_refus_parent' => $demande->motif_refus_parent,
                    'date_traitement' => $demande->date_traitement,
                    'motif_refus_admin' => $demande->motif_refus_admin,
                    'message_pub' => $demande->message_pub,
                    'remise' => $demande->remise,
                    'pack' => $demande->packs ? $demande->packs->pluck('type') : null,
                    'parent_name' => $parentNom,
                ];
                $result[] = $data;
            }

            return response()->json($result);
        }
    }

    /**
     accepter une demande
     */

    public function accepterDemande($id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $demande = Demande::findOrFail($id);
            $demande->statut_admin = 'acceptée';
            $demande->save();

            return response()->json(['message' => 'Demande acceptée avec succées'], 200);
        }
    }

    /**
     refuser une demande
     */

    public function refuserDemande($id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $demande = Demande::findOrFail($id);
            $demande->statut_admin = 'refusée';
            $demande->save();

            return response()->json(['message' => 'Demande refusée avec succées'], 200);
        }
    }
}

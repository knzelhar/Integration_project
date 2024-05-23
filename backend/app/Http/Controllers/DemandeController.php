<?php

namespace App\Http\Controllers;

use App\Models\demande;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestDemande;



class DemandeController extends Controller
{

  /**
     * ! Afficher Toutes les demandes (non traitées ,acceptées et refusées ...)
     */
    public function demandes()
    {
        // Retrieve all demands
        $demandes = demande::with(['parent_users', 'packs', 'devis', 'devis.facture'])
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
                    'pack' => $demande->packs->pluck('type'),
                    'parent_name' => $parentNom,
                    'devis' => $demande->devis->pluck('total_ttc')
                ];
                $result[] = $data;
            }

            return response()->json($result);    }

    /**
     * ! Afficher les nouvelles demandes(non traitées)
     */
    public function demandesAtraiter()
    {
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
                'pack' => $demande->packs->pluck('type'),
                'parent_name' => $parentNom,
                'devis' => $demande->devis->pluck('total_ttc')
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }

    /**
     * ! Afficher une seule demande
     */

    public function show($id)
    {
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
            'pack' => $demande->packs->pluck('type')->toArray(),
            'parent_name' => $parentNom,
            'devis' => $demande->devis->pluck('total_ttc')

        ];
        return response()->json($data);
    }

    /**
     * ! Afficher les  demandes acceptées par l'admin
     */
    public function demandeAcceptees()
    {
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
                'pack' => $demande->packs->pluck('type'),
                'parent_name' => $parentNom,
                'devis' => $demande->devis->pluck('total_ttc')
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }


    /**
     * ! Afficher les  demandes refusées par l'admin
     */

    public function demandeRefusees()
    {
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
                'pack' => $demande->packs->pluck('type'),
                'parent_name' => $parentNom,
                'devis' => $demande->devis->pluck('total_ttc')
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }

    /**
     * ! accepter une demande
     */
    public function accepterDemande($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut_admin = 'acceptée';
        $demande->save();

        return response()->json(['message' => 'Demande acceptée avec succées'], 200);
    }

    /**
     * ! refuser une demande
     */

    public function refuserDemande($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut_admin = 'refusée';
        $demande->save();

        return response()->json(['message' => 'Demande refusée avec succées'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\OffreController;
use App\Http\Controllers\parent\EnfantController;
use App\Models\offre;
use App\Models\demande;
use Illuminate\Http\Request;
use App\Models\activite;
use App\Models\option_paiement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DemandeenfantController extends Controller
{
    public function get()
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = Auth::user();

        // Vérifier si l'utilisateur est un parent_user
    if ($user->parent_user instanceof \App\Models\Parent_user) {
        // Récupérer l'ID du parent_user associé à l'utilisateur
        $parentId = $user->parent_user->id;
    }

    // Vérifier si l'utilisateur est un admin_user
    if ($user->admin_user instanceof \App\Models\admin_user) {
        // Récupérer l'ID de l'admin_user associé à l'utilisateur
        $adminId = $user->admin_user->id;
    }
     // Retourner les IDs sous forme d'un tableau JSON
     return response()->json([$parentId, $adminId]);
    }

    /**
      Creation de demande
     */

    public function createDemande()
    {
        $packId = $this->getPackId();
        $ids = $this->get();

        // Extraire les IDs individuellement
        $parentId = $ids[0];
        $adminId = $ids[1];





        // Créer une nouvelle demande avec les informations nécessaires
        $demande = new demande([
            'parent_id' => $parentId,
            'pack_id' => $packId,
            'admin_id' => null, // ID de l'admin, à définir selon votre logique
            'devis_id' => null, // ID du devis, à définir comme null pour l'instant
            'date_dem' => Carbon::now(), // Date de la demande, définie à la date et l'heure actuelles
            'statut_dem' => 'en cours', // Statut de la demande par défaut
            'statut_admin' => 'non traitée', // Statut admin par défaut
            'motif_refus_parent' => null, // Définir à null pour l'instant
            'date_traitement' => null, // Définir à null pour l'instant
            'motif_refus_admin' => null, // Définir à null pour l'instant
        ]);

        // Sauvegarder la demande
        $demande->save();
        return response()->json($demande);
    }

    /**
      Affichage d'une offre selon l'id
     */

    public function show($id)
    {
        // Instantiate an instance of the OffreController
        $offreController = new OffreController();

        // Call the show method on the instance
        return $offreController->show($id);
    }

    /**
      Affichage des enfants
     */

    public function index()
    {
        // Instantiate an instance of the EnfantController
        $EnfantController = new EnfantController();

        return $EnfantController->index();
    }

    /**
      Remplissage de la table option_paiement
     */

    public function RemplissagePaiment(Request $request)
    {

    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

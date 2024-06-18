<?php

namespace App\Http\Controllers\admin;


use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class FactureController extends Controller
{

    /**
? Afficher tous les factures
     */

    public function indexFactures()
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $factures = Facture::all();
            return response()->json($factures);
        }
    }

    /**
     Afficher une facture par id
     */
    public function getFacture($id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $facture = Facture::find($id);

            if (!$facture) {
                return response()->json(['error' => 'Facture non trouvée'], 404);
            }

            return response()->json($facture);
        }
    }
    /**
     Afficher les factures a payer
     */

    public function facturesAPayer()
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $facturesAPayers = Facture::where('statut_paiment', 'a payer')->get();
            return response()->json($facturesAPayers);
        }
    }

    /**
     Afficher les factures payées
     */
    public function facturesPayees()
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $facturesPayees = Facture::where('statut_paiment', 'payée')->get();
            return response()->json($facturesPayees);
        }
    }


    /**
     Afficher les factures non payées
     */
    public function facturesNonPayees()
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
            $facturesNonPayees = Facture::where('statut_paiment', 'non payée')->get();
            return response()->json($facturesNonPayees);
        }
    }


    /**
? Afficher les factures archivées
     */
    public function facturesArchivees()
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
        $factureArchivees = Facture::where('statut_paiment', 'archivé')->get();
        return response()->json($factureArchivees);
        }
    }

    /**
? Marquer une facture comme payée
     */
    public function MarquerPayees($id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
        $facture = Facture::findOrFail($id);
        $facture->statut_paiment = 'payée';
        $facture->save();

        return response()->json(['message' => 'Facture marquée comme payée avec succées'], 200);
        }
    }
    /**
? Marquer une facture comme non payée
     */
    public function MarquerNonPayees($id)
    {
        $user = Auth::User();
        $role = $user->role;
        if ($role === 0) {
        $facture = Facture::findOrFail($id);
        $facture->statut_paiment = 'non payée';
        $facture->save();

        return response()->json(['message' => 'Facture marquée comme non payée avec succées'], 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{

    /**
? Afficher tous les factures
     */

    public function indexFactures()
    {
        $factures = Facture::all();

        $result = [];
        foreach ($factures as $Facture) {
            $data = [
                'date' => $Facture->date,
                'total_ht' => $Facture->total_ht,
                'total_ttc' => $Facture->total_ttc,
                'statut_paiment' => $Facture->statut_paiment,
                'facture_pdf' => $Facture->facture_pdf
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }

    /**
? Afficher une facture par id
     */
    public function getFacture($id)
    {
        $facture = Facture::find($id);

        if (!$facture) {
            return response()->json(['error' => 'Facture non trouvée'], 404);
        }

        $data = [
            'date' => $facture->date,
            'total_ht' => $facture->total_ht,
            'total_ttc' => $facture->total_ttc,
            'statut_paiment' => $facture->statut_paiment,
            'facture_pdf' => $facture->facture_pdf
        ];

        return response()->json($data);
    }
    /**
? Afficher les factures a payer
     */

    public function facturesAPayer()
    {
        $facturesAPayers = Facture::where('statut_paiment', 'a payer')->get();

        $result = [];
        foreach ($facturesAPayers as $facturesAPayer) {
            $data = [
                'date' => $facturesAPayer->date,
                'total_ht' => $facturesAPayer->total_ht,
                'total_ttc' => $facturesAPayer->total_ttc,
                'statut_paiment' => $facturesAPayer->statut_paiment,
                'facture_pdf' => $facturesAPayer->facture_pdf
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }

    /**
? Afficher les factures payées
     */
    public function facturesPayees()
    {
        $facturesPayees = Facture::where('statut_paiment', 'payée')->get();

        $result = [];
        foreach ($facturesPayees as $facturesPayee) {
            $data = [
                'date' => $facturesPayee->date,
                'total_ht' => $facturesPayee->total_ht,
                'total_ttc' => $facturesPayee->total_ttc,
                'statut_paiment' => $facturesPayee->statut_paiment,
                'facture_pdf' => $facturesPayee->facture_pdf
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }


    /**
? Afficher les factures non payées
     */
    public function facturesNonPayees()
    {
        $facturesNonPayees = Facture::where('statut_paiment', 'non payée')->get();

        $result = [];
        foreach ($facturesNonPayees as $facturesNonPayee) {
            $data = [
                'date' => $facturesNonPayee->date,
                'total_ht' => $facturesNonPayee->total_ht,
                'total_ttc' => $facturesNonPayee->total_ttc,
                'statut_paiment' => $facturesNonPayee->statut_paiment,
                'facture_pdf' => $facturesNonPayee->facture_pdf
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }


      /**
? Afficher les factures archivées
     */
    public function facturesArchivees()
    {
        $factureArchivees = Facture::where('statut_paiment', 'archivé')->get();

        $result = [];
        foreach ($factureArchivees as $factureArchivee) {
            $data = [
                'date' => $factureArchivee->date,
                'total_ht' => $factureArchivee->total_ht,
                'total_ttc' => $factureArchivee->total_ttc,
                'statut_paiment' => $factureArchivee->statut_paiment,
                'facture_pdf' => $factureArchivee->facture_pdf
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }

    /**
? Marquer une facture comme payée
     */
    public function MarquerPayees($id)
    {
        $facture = Facture::findOrFail($id);
        $facture->statut_paiment = 'payée';
        $facture->save();

        return response()->json(['message' => 'Facture marquée comme payée avec succées'], 200);
    }
    /**
? Marquer une facture comme non payée
     */
    public function MarquerNonPayees($id)
    {
        $facture = Facture::findOrFail($id);
        $facture->statut_paiment = 'non payée';
        $facture->save();

        return response()->json(['message' => 'Facture marquée comme non payée avec succées'], 200);
    }
}

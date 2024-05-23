<?php

namespace App\Http\Controllers;

use App\Http\Requests\requestpack;
use App\Models\pack;
use Illuminate\Http\Request;

class PackController extends Controller
{

    /**
? Afficher tous les Packs disponibles
     */

    public function index()
    {
        $packs = pack::all();

        $result = [];
        foreach ($packs as $pack) {
            $data = [
                'type' => $pack->type,
                'remise' => $pack->remise,
                'nbr_enfant' => $pack->nbr_enfant,
                'nbr_atelier' => $pack->nbr_atelier
            ];
            $result[] = $data;
        }

        return response()->json($result);
    }
    /**
? Afficher un seul pack par id
     */
    public function show($id)
    {
        $pack = Pack::findOrFail($id);

        $data = [
            'id' => $pack->id,
            'type' => $pack->type,
            'remise' => $pack->remise,
            'nbr_enfant' => $pack->nbr_enfant,
            'nbr_atelier' => $pack->nbr_atelier

        ];
        return response()->json($data);
    }
    /**
? Ajouter un pack
     */
    public function store(request $request)
    {
        $request->validate([
            'type' => 'required|string|in:pack_nbr_enf,pack_atelier',
            'remise' => 'nullable|numeric',
            'nbr_enfant' => 'nullable|numeric',
            'nbr_atelier' => 'nullable|numeric',

        ]);

        $pack = Pack::create([
            'type' => $request->type,
            'remise' => $request->remise,
            'nbr_enfant' => $request->nbr_enfant,
            'nbr_atelier' => $request->nbr_atelier
        ]);

        return response()->json($pack, 201);
    }

    /**
? Modifier un pack
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|in:pack_nbr_enf,pack_atelier',
            'remise' => 'required|numeric',
            'nbr_enfant' => 'nullable|numeric',
            'nbr_atelier' => 'nullable|numeric',
        ]);
        $pack = Pack::findOrFail($id);
        if (!$pack) {
            return response()->json(['message' => 'Pack not found'], 404);
        }
        $pack->type = $request->input('type', $pack->type);
        $pack->remise = $request->input('remise', $pack->remise);
        $pack->nbr_enfant = $request->input('nbr_enfant', $pack->nbr_enfant);
        $pack->nbr_atelier = $request->input('nbr_atelier', $pack->nbr_atelier);

        $pack->save();

        return response()->json(['message' => 'Pack updated successfully']);
    }

    /**
? Supprimer un pack
     */
    public function destroy($id)
    {
        $pack = Pack::find($id);

        if (!$pack) {
            return response()->json(['message' => 'Pack not found'], 404);
        }

        $pack->delete();

        return response()->json(['message' => 'Pack deleted successfully']);
    }
}

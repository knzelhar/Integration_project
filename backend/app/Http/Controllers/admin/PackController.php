<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackController extends Controller
{

    /**
     Afficher tous les Packs disponibles
     */

    public function index()
    {
        // $user = Auth::User();
        // $role = $user->role;

        // if ($role === 0) {
            $packs = pack::all();
            return response()->json($packs);
        // }
    }


    /**
     Afficher un seul pack par id
     */


    public function show($id)
    {
        // $user = Auth::User();
        // $role = $user->role;

        // if ($role === 0) {
            $pack = Pack::findOrFail($id);
            return response()->json($pack);
        // }
    }

    /**
     Ajouter un pack
     */

    public function store(request $request)
    {
        // $user = Auth::User();
        // $role = $user->role;

        // if ($role === 0) {
            $request->validate([
                'type' => 'required|string|in:pack_nbr_enf,pack_atelier',
                'remise' => 'nullable|numeric',
                'nbr_enfant' => 'nullable|integer',
                'nbr_atelier' => 'nullable|integer',

            ]);

            $pack = Pack::create([
                'type' => $request->type,
                'remise' => $request->remise,
                'nbr_enfant' => $request->nbr_enfant,
                'nbr_atelier' => $request->nbr_atelier
            ]);
            $pack->save();

            return response()->json($pack, 201);
        // }
    }

    /**
     Modifier un pack
     */

    public function update(Request $request, $id)
    {
        // $user = Auth::User();
        // $role = $user->role;

        // if ($role === 0) {
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
        // }
    }

    /**
     Supprimer un pack
     */

    public function destroy($id)
    {
        // $user = Auth::User();
        // $role = $user->role;

        // if ($role === 0) {
            $pack = Pack::find($id);

            if (!$pack) {
                return response()->json(['message' => 'Pack not found'], 404);
            }

            $pack->delete();

            return response()->json(['message' => 'Pack deleted successfully']);
        // }
    }
}

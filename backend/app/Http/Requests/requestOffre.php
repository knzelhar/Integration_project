<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\admin\OffreController;

class requestoffre extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => 'required|string',
            'description' => 'required|string',
            'date_creation' => 'required',
            // 'date_mise_a_jour' => 'date_format:d/m/Y',
            'date_debut_insc' => 'nullable|string',
            'date_fin_insc' => 'nullable|string',
            'volume_horaire' => 'required|numeric',
            'message_pub' => 'required|string',
            'remise' => 'required|numeric',
            'activite_titres' => 'required|exists:activites,titre',
            'nbr_seances_sem' => 'required|integer',
            'duree' => 'required|numeric',
        ];
    }
}

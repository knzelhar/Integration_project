<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestanimateur extends FormRequest
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
            'domaine_comp' => 'required|string:animateur_users,domaine_comp',
            'role' => 'required|integer:users,role',
            'animateur_id' => 'required|integer',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',

        ];
    }
}

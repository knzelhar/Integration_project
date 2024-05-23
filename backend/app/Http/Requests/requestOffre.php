<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestOffre extends FormRequest
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
           // 'volume_horaire' => 'required',
            'message_pub' => 'required',
            'description' => 'required',
            //'date_fin_insc' => 'required',
           // 'date_debut_insc' => 'required',
           // 'date_mise_a_jour' => 'required',
           // 'date_creation' => 'required',
            'remise' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
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
            // 'type' => 'required|string',
            // 'cours_id' => 'required|integer|exists:courses,id',
            // 'titre' => 'required|string|max:255',
            // 'description' => 'required|string',
            // 'duree' => 'nullable|integer',
            // 'nombre_pages' => 'nullable|integer',
            // 'chemin' => 'required|string', 
        ];
    }
    public function messages()
    {
        return [
            // 'type.required' => 'Le type est requis.',
            // 'cours_id.required' => 'Le cours est requis.',
            // 'cours_id.exists' => 'Ce cours n\'existe pas.',
            // 'titre.required' => 'Le titre est requis.',
            // 'description.required' => 'La description est requise.',
            // 'chemin.required' => 'Le chemin du contenu est requis.',
            // 'duree.integer' => 'La durée doit être un nombre entier.',
            // 'nombre_pages.integer' => 'Le nombre de pages doit être un nombre entier.',
        ];
    }
}

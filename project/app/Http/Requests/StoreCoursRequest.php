<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoursRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|unique:categories,nom', 
            'avatar' => 'nullable|image',
            'description' => 'nullable|string',
        ];
    }
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la catégorie est requis.',
            'nom.unique' => 'Cette catégorie existe déjà.',
            'avatar.image' => 'L\'avatar doit être une image valide.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}

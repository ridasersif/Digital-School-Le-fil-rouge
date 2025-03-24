<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'nom' => 'required|unique:categories,nom', 
            'icon' => 'required|string',
            'description' => 'required|string',
            
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
            'description.required' => 'Le description de la catégorie est requis.',
            'nom.unique' => 'Cette catégorie existe déjà.',
            'icon.required' => 'L\'icône de la catégorie est requise.',
            'icon.string' => 'L\'icône doit être une chaîne de caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        session()->flash('is_create', true); 
        parent::failedValidation($validator);
    }

}

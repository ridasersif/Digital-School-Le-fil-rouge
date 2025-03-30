<?php
namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'birthdate' => 'nullable|date',
            'occupation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'facebook_profile' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champ "Nom" est requis.',
            'name.string' => 'Le champ "Nom" doit être une chaîne de caractères.',
            'name.max' => 'Le champ "Nom" ne doit pas dépasser 255 caractères.',
            'phone.regex' => 'Veuillez entrer un numéro de téléphone valide.',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins 9 chiffres.',
            'birthdate.date' => 'Veuillez entrer une date valide.',
            'occupation.string' => 'Le champ "Occupation" doit être une chaîne de caractères.',
            'occupation.max' => 'Le champ "Occupation" ne doit pas dépasser 255 caractères.',
            'address.string' => 'Le champ "Adresse" doit être une chaîne de caractères.',
            'address.max' => 'Le champ "Adresse" ne doit pas dépasser 255 caractères.',
            'website.url' => 'Veuillez entrer une URL valide pour le site Web.',
            'facebook_profile.string' => 'Le champ "Profil Facebook" doit être une chaîne de caractères.',
            'facebook_profile.max' => 'Le champ "Profil Facebook" ne doit pas dépasser 255 caractères.',
        ];
    }
}

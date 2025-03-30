<?php
namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'current_password.string' => 'Le mot de passe actuel doit être une chaîne de caractères.',
            'new_password.required' => 'Le nouveau mot de passe est requis.',
            'new_password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'new_password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ];
    }
}

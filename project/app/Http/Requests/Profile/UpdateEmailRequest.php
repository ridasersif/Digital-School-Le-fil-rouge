<?php
namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateEmailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /** 
         * @var User|null $user
         */
        $user = auth()->user();

        return [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|string',
        ];
    }

    /**
     * Get the custom error messages for the validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'L\'email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
        ];
    }
}

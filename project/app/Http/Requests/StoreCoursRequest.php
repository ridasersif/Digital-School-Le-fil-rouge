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
            'titre' => 'required|string|max:255', 
            'description' => 'required|string|max:1000',
            'category_id' => 'required|integer|exists:categories,id', 
            'price' => 'required|numeric|min:0', 
            'old_price' => 'nullable|numeric|gt:price', // old_price > price
            'video_intro' => 'nullable|mimes:mp4,mov,avi,wmv|max:50000', 
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', 
            'formateur_id' => 'required|exists:users,id', 
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
            'titre.required' => 'Le titre du cours est obligatoire.',
            'description.required' => 'La description du cours est obligatoire.',
            'category_id.required' => 'La catégorie du cours est obligatoire.',
            'price.required' => 'Le prix du cours est obligatoire.',
            'video_intro.mimes' => 'Le format de la vidéo d’introduction n\'est pas valide.',
            'image.mimes' => 'Le format de l\'image de couverture n\'est pas valide.',
            'old_price.gt' => 'Le prix barré doit être supérieur au prix actuel.',
        ];
    }
}

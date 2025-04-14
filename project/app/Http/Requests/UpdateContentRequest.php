<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:video,pdf,link',
            'cours_id' => 'required|exists:cours,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        switch ($this->type) {
            case 'video':
                $rules['chemin_video'] = 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200'; 
                $rules['duree_video'] = 'nullable|integer|min:1';
                break;
            case 'pdf':
                $rules['chemin_pdf'] = 'nullable|file|mimes:pdf|max:20480'; 
                $rules['nombre_pages_pdf'] = 'nullable|integer|min:1';
                break;
            case 'link':
                $rules['chemin_lien'] = 'required';
                $rules['duree_lien'] = 'nullable|integer|min:1';
                break;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'type.required' => 'Le type de contenu est requis.',
            'type.in' => 'Le type de contenu sélectionné est invalide.',
            'cours_id.required' => 'Le cours est requis.',
            'cours_id.exists' => 'Le cours sélectionné n’existe pas.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L’image doit être de type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'L’image ne doit pas dépasser 2 Mo.',

            'chemin_video.file' => 'Le fichier vidéo n’est pas valide.',
            'chemin_video.mimes' => 'Le format de la vidéo doit être: mp4, mov, avi, wmv.',
            'chemin_video.max' => 'La vidéo ne doit pas dépasser 50 Mo.',
            'duree_video.integer' => 'La durée doit être un nombre entier.',
            'duree_video.min' => 'La durée doit être d’au moins 1 minute.',

            'chemin_pdf.file' => 'Le fichier n’est pas valide.',
            'chemin_pdf.mimes' => 'Le fichier doit être au format PDF.',
            'chemin_pdf.max' => 'Le fichier PDF ne doit pas dépasser 20 Mo.',
            'nombre_pages_pdf.integer' => 'Le nombre de pages doit être un nombre entier.',
            'nombre_pages_pdf.min' => 'Le nombre de pages doit être au moins 1.',

            'chemin_lien.required' => 'L’URL du lien est obligatoire.',
            'duree_lien.integer' => 'La durée doit être un nombre entier.',
            'duree_lien.min' => 'La durée doit être d’au moins 1 minute.',
        ];
    }
}

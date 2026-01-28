<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
        $rules = [
            'nom' => 'required|min:5',
            'prix' => 'required|numeric',
            'categorie' => 'required',
            'image' => 'required|image|max:2048'
        ];

        // Si c'est une mise à jour (PUT/PATCH), l'image n'est pas obligatoire
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = 'nullable|image|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'nom.min' => 'Le nom doit contenir au moins 5 caractères.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre valide.',
            'categorie.required' => 'Veuillez sélectionner une catégorie.',
            'image.required' => 'Une image est requise.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne doit pas dépasser 2Mo.'
        ];
    }
}

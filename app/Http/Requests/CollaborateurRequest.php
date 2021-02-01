<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollaborateurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        return [
            'matricule' => 'bail|required|unique:collaborateurs|max:7|alpha_num',
            'nom' => 'bail|required|max:50|string',
            'prenoms' => 'bail|required|max:25|string',
            'date_de_naissance' => 'bail|required',
            'lieu_de_naissance' => 'bail|required|between:5,25|string',
            'ancienne_fonction' =>'required',
            'numero_identite' =>'required',
            'nouvelle_fonction' =>'required',
            'categorie' => 'required',
            'contact' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'matricule.unique' => 'Ce matricule existe deja dans la base de donnees',
            'date_de_naiss.required' => 'le champ date de naissance est obligatoire',
            'lieu_de_naiss.required' => 'le champ lieu de naissance est obligatoire',
            'numero_identite.required' => 'le champ lieu de naissance est obligatoire',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
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

                'matricule' => 'bail|exists:collaborateurs|required',
                'type' =>'required',
                'date_reception' => 'required',
    
        ];
    }
    public function messages()
    {
        return [
            'exists' => 'Ce numero matricule ne correspond pas a un collaborateur',
            'required' => 'Ce champs est obligatoire',
        ];
    }
}

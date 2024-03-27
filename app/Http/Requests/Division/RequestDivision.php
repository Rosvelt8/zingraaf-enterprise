<?php

namespace App\Http\Requests\Division;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestDivision extends FormRequest
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
            'name'=>'max:50',
            'enterprise'=>'numeric|exists:enterprises,ident',
            'division'=>'required|numeric|exists:divisions,iddiv',
            
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=> false,
            'status_code'=> 422,
            'error' => true,
            'message' => 'Erreur de validation',
            'errorList'=> $validator->errors()
        ]));
    }

    public function messages(){
        return [
            'enterprise.exists'=> 'Please provide an existing enterprise',
            'division.exists'=> 'Please provide an existing division',
            
        ];
    }
}

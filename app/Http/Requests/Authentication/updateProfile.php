<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'max:100',
            'surname'=>'max:100',
            'email'=>'email|max:255|unique:users',
            'role'=>'max:2',
            'phone'=>'max:20',
            'division'=>'numeric|exists:divisions,iddiv',
            'enterprise'=>'numeric|exists:enterprises,ident',
            'category'=>'numeric|exists:categories_employee,idcat'
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
            'division.exist'=> 'division not exist',
            'enterprise.exist'=> 'enterprise not exist',
            'category.exist'=> 'category not exist'
        ];
    }
}

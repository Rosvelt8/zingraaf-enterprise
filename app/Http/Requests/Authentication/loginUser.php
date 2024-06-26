<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class loginUser extends FormRequest
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


    public function rules()
    {
        return [
            
            'identifiant'=>'required|regex:/^ZENT\d{4}\d{4}$/|max:12|exists:users,identifiant',
            'password'=>'required|min:6',
            
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=> false,
            'status_code'=> 422,
            'error' => true,
            'message' => 'Validation error',
            'errorList'=> $validator->errors()
        ]));
    }

    public function messages(){
        return [
            
            'identifiant.required'=> 'Please provide an email',
            'identifiant.regex'=> 'Invalid format provided',
            'identifiant.exists'=> 'This email does not exist',
            'password.required'=> 'Please provide an password',
        ];
    }
}

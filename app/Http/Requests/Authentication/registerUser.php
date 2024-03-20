<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registerUser extends FormRequest
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
            'name'=>'required|max:100',
            'surname'=>'required|max:100',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|min:8|confirmed',
            'role'=>'required|max:2',
            'phone'=>'required|max:20'
            // 'address'=>'required|max:255',
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
            'name.required'=> 'Please provide a name',
            'surname.required'=> 'Please provide a surname',
            'email.required'=> 'Please provide an email',
            'email.unique'=> 'This email is already exist',
            'password.required'=> 'Please provide an password',
            'phone.required'=> 'Please provide a phone number',
            'role.required'=> 'You could not create user without role',
        ];
    }
}

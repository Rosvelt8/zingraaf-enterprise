<?php

namespace App\Http\Requests\Enterprise;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestEnterprise extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'enterprise'=>'required|exists:enterprise,ident',
            'name'=>'max:50',
            'contact'=>'max:50',
            'address'=>'max:50',
            'open_hours'=>'date_format:H:i:s',
            'close_hours'=>'date_format:H:i:s',
            
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
            'enterprise.exists'=> 'Please provide an existing enterprise enterprise',
            'open_hours.date_format'=> 'Please provide a time in format 00:00:00',
            'close_hours.date_format'=> 'Please provide a time in format 00:00:00',
            
        ];
    }
}


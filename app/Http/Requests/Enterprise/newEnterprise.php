<?php

namespace App\Http\Requests\Enterprise;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class newEnterprise extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name'=>'required|max:50',
            'contact'=>'required|max:50',
            'address'=>'required|max:50',
            'open_hours'=>'required|date_format:H:i:s',
            'close_hours'=>'required|date_format:H:i:s',
            
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
            'name.required'=> 'Please provide an enterprise name',
            'address.required'=> 'Please provide an enterprise address',
            'contact.required'=> 'Please provide an enterprise contact',
            'open_hours.date_format'=> 'Please provide a time in format 00:00:00',
            'close_hours.date_format'=> 'Please provide a time in format 00:00:00',
            
        ];
    }
}

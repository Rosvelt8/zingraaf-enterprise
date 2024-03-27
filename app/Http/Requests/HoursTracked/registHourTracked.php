<?php

namespace App\Http\Requests\HoursTracked;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class registHourTracked extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'cookie'=>'required|numeric',

        ];
    }

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
            'cookie.required'=> 'Please enter time to track',
            'cookie.numeric'=> 'Please enter a valid numeric',
        ];
    }
}

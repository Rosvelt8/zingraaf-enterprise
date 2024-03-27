<?php

namespace App\Http\Requests\HoursSupp;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class newHourSupp extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'employee'=>'required|exists:users,id',
            'begin_time'=>'required|date_format:H:i:s',
            'end_time'=>'required|date_format:H:i:s',
            
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
            
            'employee.required'=> 'Please provide an existing employee',
            'begin_time.date_format'=> 'Please provide a time in format 00:00:00',
            'end_time.date_format'=> 'Please provide a time in format 00:00:00',
            
        ];
    }
}

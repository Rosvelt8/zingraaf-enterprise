<?php

namespace App\Http\Requests\TaskReport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class newTaskReport extends FormRequest
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
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'task_ass'=>'required|exists:tasks_assign,idtask_ass',

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
            'task_ass.exists'=> 'Please an existing task assign',
            'photos.*.image'=> 'Please provide an image'
        ];
    }
}

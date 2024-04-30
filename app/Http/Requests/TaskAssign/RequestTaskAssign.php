<?php

namespace App\Http\Requests\TaskAssign;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestTaskAssign extends FormRequest
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

            'employees'=>'array|array.numeric',
            'taskAssign'=>'exists:tasks_assign,idtask_ass',

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
            'employees.*.numeric'=> 'Employee must be a number',
            'employees.required'=> 'You need at least one employee for assign the task',
            'employees.array'=> 'Employees should be in array format',
            'task.exists'=> 'Please an existing task'
        ];
    }
}

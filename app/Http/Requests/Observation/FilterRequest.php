<?php

namespace App\Http\Requests\Observation;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //'site' => '',
            //'location' => '',
            //'further' => '',
            //'corrective' => '',
            //'comments' => '',
            //'description' => 'string',
            'status_id' => 'integer',
            'department_id'=>'integer',
            'user_id'=>'integer',
            'created_at'=>'string',
            'start_date'=>'string',
            'end_date'=>'string',


        ];
    }
}

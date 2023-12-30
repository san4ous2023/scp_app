<?php

namespace App\Http\Requests\Observation;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'site' => '',
            'location' => '',
            'further' => '',
            'corrective' => '',
            //'comments' => '',
            'description' => 'required',
            //'status_id' => 'integer',
            'department_id'=>'required',
            'user_id'=>'required'
        ];
    }
}

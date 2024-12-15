<?php

namespace App\Http\Requests\Observation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

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
//            'site' => '',
//            'location' => '',
//            'further' => '',
//            'corrective' => '',
//            //'comments' => '',
//            'description' => 'required',
//            //'status_id' => 'integer',
//            'department_id'=>'required',
//            'user_id'=>'required',
//            'safeCheckbox'=>'',
//            'riskCheckbox'=>'',
//            'unsafeCheckbox'=>'',
//            'qualityCheckbox'=>'',
//            'environmentalCheckbox'=>'',
//            //'photos'=> ''
//            'photos.*'=> 'image|max:2048'
//            //'photos.*'=> [File::image()->max(2*1024)],
            'site' => 'nullable|string',
            'location' => 'nullable|string',
            'further' => 'nullable|string',
            'corrective' => 'nullable|string',
            'description' => 'required|string',
            'department_id' => 'required|integer',
            'user_id' => 'required|integer',
            'safeCheckbox' => 'nullable|array',
            'riskCheckbox' => 'nullable|array',
            'unsafeCheckbox' => 'nullable|array',
            'qualityCheckbox' => 'nullable|array',
            'environmentalCheckbox' => 'nullable|array',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|file|image|max:2048', // Each photo must be an image and max 2MB

        ];
    }
}

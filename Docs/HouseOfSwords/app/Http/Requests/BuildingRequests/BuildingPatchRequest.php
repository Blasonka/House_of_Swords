<?php

namespace App\Http\Requests\BuildingRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BuildingPatchRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->Params) {
            $this->merge([
                'Params' => json_encode($this->Params)
            ]);
        }

        return [
            'Towns_TownID' => 'integer|min:1',
            'BuildingType' => 'alpha|in:Barracks,Warehouse,Research,Infirmary,Market,Diplomacy,Church',
            'BuildingLvl' => 'integer|min:1',
            'Params' => 'json'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'TownName.required' => 'A TownName is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}

<?php

namespace App\Http\Requests\TownRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TownCreationRequest extends FormRequest
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
        return [
            'TownName' => 'required|string|min:5|max:20' //,
            // 'HappinessValue' => 'integer',
            // 'Wood' => 'integer|min:0',
            // 'Stone' => 'integer|min:0',
            // 'Metal' => 'integer|min:0',
            // 'Gold' => 'integer|min:0',
            // 'CampaignLvl' => 'integer|min:0',
            // 'XCords' => 'integer',
            // 'YCords' => 'integer'
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

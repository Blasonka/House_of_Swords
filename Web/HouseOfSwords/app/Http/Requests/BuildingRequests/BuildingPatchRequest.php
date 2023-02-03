<?php

namespace App\Http\Requests\BuildingRequests;

use Illuminate\Foundation\Http\FormRequest;

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
}

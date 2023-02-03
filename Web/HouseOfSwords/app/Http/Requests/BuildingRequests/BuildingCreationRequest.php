<?php

namespace App\Http\Requests\BuildingRequests;

use Illuminate\Foundation\Http\FormRequest;

class BuildingCreationRequest extends FormRequest
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
        $this->merge([
            'Params' => json_encode($this->Params)
        ]);

        return [
            'Towns_TownID' => 'integer|required|min:1',
            'BuildingType' => 'alpha|required|in:Barracks,Warehouse,Research,Infirmary,Market,Diplomacy,Church',
            'BuildingLvl' => 'integer|required|min:1',
            'Params' => 'json|required'
        ];
    }
}

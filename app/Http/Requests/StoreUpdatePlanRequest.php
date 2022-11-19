<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePlanRequest extends FormRequest
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
        $url = $this->segment(3); //Pega no seguimento da url o terceiro elemento Ex:

        return [
            'name' => "required|min:3|max:255|unique:plans,name,{$url},url", //Excepto se alteracao for feita nos outros campos
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'description' => 'nullable|min:3|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTablesRequest extends FormRequest
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
        $id = $this->segment(3); //Pega o id no segmento da URL
        return [
            'identify' => ['required', 'min:3', 'max:255', "unique:tables,identify,{$id},id"],
            'description' => ['nullable', 'min:3', 'max:10000'],
        ];
    }
}

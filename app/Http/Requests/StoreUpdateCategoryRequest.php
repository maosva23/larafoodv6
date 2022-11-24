<?php

namespace App\Http\Requests;

use App\Tenant\Rules\UniqueTenant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategoryRequest extends FormRequest
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
            //'name' => ['required', 'min:3', 'max:255', "unique:categories,name,{$id},id"],
            'name' => [
                'required',
                'min:3',
                'max:255',
                //"unique:categories,name,{$id},id",
                /**Cria um objecto do tipo UniqueTenant encarregue para validação
                 * do campo unico e espera como parametro o nome da tabela 'categories' */
                new UniqueTenant('categories', $id),
            ],
            'description' => ['required', 'min:3', 'max:10000'],
        ];
    }
}

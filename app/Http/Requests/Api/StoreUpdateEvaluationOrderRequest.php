<?php

namespace App\Http\Requests\Api;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEvaluationOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**Recupera o cliente autenticado*/
        if(!$client = auth()->user()){
            return false;
        }

        /**Recupara a ordem (pedido) pelo identificadro*/
        if (!$order = app(OrderRepositoryInterface::class)->getOrderByIdentify($this->identifyOrder)){
            return false;
        }

//        dd($order);
        /**Retorna verdadeiro de client->id for igual a order->client_id*/
        return $client->id == $order->client_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'min:3', 'max:1000'],
        ];
    }
}

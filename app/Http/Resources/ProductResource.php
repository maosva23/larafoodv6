<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'tenant_id' => $this->tenant_id,
//            'flag' => $this->flag,
            'identify' => $this->uuid,
            'name' => $this->name,
            'price' => $this->price,
            'image' => url("storage/{$this->image}"),
            'description' => $this->description
        ];
    }
}

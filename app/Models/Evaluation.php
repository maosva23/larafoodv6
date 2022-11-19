<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'order_evaluations';//Renomear a tabela da base de dados

    protected $fillable = [
         'order_id', 'client_id', 'stars','comment'
    ];


    /**Relacionamentos ManyToOne*/
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

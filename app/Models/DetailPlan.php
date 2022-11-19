<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    protected $table = 'details_plan'; //Atribuicao de nome na tabela

    protected $fillable = ['name']; //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * ManyToOne Muitos detalhes pertencem a um plano
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}

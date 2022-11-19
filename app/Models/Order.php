<?php

namespace App\Models;

use App\Tenant\Traits\TenantTraits;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use TenantTraits;

    protected $fillable = [
        'tenant_id',
        'identify',
        'client_id',
        'table_id',
        'total',
        'status',
        'comment'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**Relaciomanto OneToMany*/
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}

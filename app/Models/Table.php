<?php

namespace App\Models;

use App\Tenant\Traits\TenantTraits;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use TenantTraits;

    protected $fillable = [
        'tenant_id', 'identify', 'description', 'uuid'
    ];
}

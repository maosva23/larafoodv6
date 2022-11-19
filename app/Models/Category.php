<?php

namespace App\Models;

use App\Tenant\Traits\TenantTraits;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TenantTraits; //Encarregue de inserir os tenant_id atraves do arquivo Tenant/Traits/TenantTraits.php

    protected $fillable = [
        'name', 'url', 'description', 'uuid'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * MuitosParaMuitos
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

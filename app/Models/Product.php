<?php

namespace App\Models;

use App\Tenant\Traits\TenantTraits;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTraits; //Encarregue de iserir os tenant_id

    protected $fillable = [
        'name', 'price', 'description', 'image', 'uuid'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * MuitosParaMuitos
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    /**
     * Busca todas Categorias que não tem ligacao com o Produto
     */
    public function categoriesAvailable($filter = null)
    {
        $categories = Category::whereNotIn('id', function ($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter) {
                    $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();

        return $categories;
    }
}

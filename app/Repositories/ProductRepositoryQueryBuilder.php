<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;


class ProductRepositoryQueryBuilder implements ProductRepositoryInterface
{
    protected $table;

    public function __construct(Product $product)
    {
        $this->table = 'products';
    }

/*
    public function getProductsByTenantUuid(string $uuid)
    {

//        dd($uuid);
        // TODO: Implement getAllProductsByTenantUuid() method.
        $products = DB::table($this->table)
            ->join('tenants', 'tenants.id', '=','products.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('products.*')
//            ->get()
            ->paginate();
        return $products;
    }
*/


    public function getProductsByTenantId(int $idTenant, array $categories)
    {

        /*$products = DB::table($this->table)
            ->where('tenant_id', $idTenant)
            ->get();*/

        $products = DB::table($this->table)
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('products.tenant_id', $idTenant)
            ->where('categories.tenant_id', $idTenant)
            ->where(function ($query) use ($categories){
                if ($categories != [])
                    $query->whereIn('categories.uuid', $categories);
            })
            ->select('products.*')
            ->get();

        return $products;
    }



    public function getProductByUuid(string $uuid)
    {
        // TODO: Implement getProductByUrl() method.
        $product = DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();

        return $product;
    }

}

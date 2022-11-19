<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;


class CategoryRepositoryQueryBuilder implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct(Category $category)
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {

//        dd($uuid);
        // TODO: Implement getAllCategoriesByTenantUuid() method.
        $categories = DB::table($this->table)
            ->join('tenants', 'tenants.id', '=','categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categories.*')
//            ->get()
            ->paginate();
        return $categories;
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        $categories = DB::table($this->table)
            ->where('tenant_id', $idTenant)
            ->get();

        return $categories;
    }

    public function getCategoryByUuid(string $uuid)
    {
        // TODO: Implement getCategoryByUrl() method.
        $category = DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();

        return $category;
    }
}

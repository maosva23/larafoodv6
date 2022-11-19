<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface
{
    protected $entity;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        // TODO: Implement getAllCategoriesByTenantUuid() method.
        $categories = $this->entity
            ->join('tenants', 'tenants.id', '=','categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categories.*')
            ->get();
        return $categories;
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        $categories = $this->entity
            ->where('tenant_id', $idTenant)
            ->get();

        return $categories;
    }

    public function getCategoryByUrl(string $url)
    {
        // TODO: Implement getCategoryByUrl() method.
    }
}

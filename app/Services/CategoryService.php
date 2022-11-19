<?php

namespace App\Services;



//use Illuminate\Support\Str;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService
{

    protected $tenantRepository, $categoryRepositoryQueryBuilder;

    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        CategoryRepositoryInterface $categoryRepositoryQueryBuilder
    )
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepositoryQueryBuilder = $categoryRepositoryQueryBuilder;

    }


    public function getCategoriesByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        $categories = $this->categoryRepositoryQueryBuilder->getCategoriesByTenantId($tenant->id);

        return $categories;
    }

    public function getCategoryByUuid(string $uuid)
    {
        $category = $this->categoryRepositoryQueryBuilder->getCategoryByUuid($uuid);
        return $category;
    }
}

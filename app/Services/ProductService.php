<?php

namespace App\Services;



//use Illuminate\Support\Str;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{

    protected $productRepositoryQueryBuilder, $tenantRepository;

    public function __construct(
        ProductRepositoryInterface $productRepositoryQueryBuilder,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->productRepositoryQueryBuilder = $productRepositoryQueryBuilder;
        $this->tenantRepository = $tenantRepository;
    }


    public function getProductsByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        $products = $this->productRepositoryQueryBuilder->getProductsByTenantId($tenant->id, $categories);

        return $products;
    }


    public function getProductByUuid(string $uuid)
    {
        $product = $this->productRepositoryQueryBuilder->getProductByUuid($uuid);
        return $product;
    }

}

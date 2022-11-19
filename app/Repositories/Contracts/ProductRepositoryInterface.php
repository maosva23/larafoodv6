<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
//    public function getProductsByTenantUuid(string $uuid);


    public function getProductsByTenantId(int $idTenant, array $categories);

    public function getProductByUuid(string $uuid);

}

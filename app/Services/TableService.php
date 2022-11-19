<?php

namespace App\Services;



//use Illuminate\Support\Str;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TableRepositoryQueryBuilder;

class TableService
{

    protected $tenantRepository, $tableRepositoryQueryBuilder;

    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepositoryQueryBuilder
    )
    {
        $this->tenantRepository = $tenantRepository;
        $this->tableRepositoryQueryBuilder = $tableRepositoryQueryBuilder;

    }


    public function getTablesByTenantUuid(string $uuid)
    {
//        dd($uuid);
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
//        dd($tenant->id);
        $tables = $this->tableRepositoryQueryBuilder->getTablesByTenantUuid($tenant->id);
//        dd($tables);
        return $tables;
    }

    public function getTableByUuid(string $uuid)
    {
        $table = $this->tableRepositoryQueryBuilder->getTableByUuid($uuid);
        return $table;
    }
}

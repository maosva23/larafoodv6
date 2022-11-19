<?php

namespace App\Repositories;

use App\Models\Table;
use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;


class TableRepositoryQueryBuilder implements TableRepositoryInterface
{
    protected $table;

    public function __construct(Table $table)
    {
        $this->table = 'tables';
    }

    public function getTablesByTenantUuid(string $uuid)
    {
//        dd($uuid);
        // TODO: Implement getAllTablesByTenantUuid() method.
        $tables = DB::table($this->table)
            ->join('tenants', 'tenants.id', '=','tables.tenant_id')
            ->where('tenants.id', $uuid)
            ->select('tables.*')
//            ->get()
            ->paginate();

//        dd($tables);
        return $tables;
    }

    public function getTablesByTenantId(int $idTenant)
    {
        $tables = DB::table($this->table)
            ->where('tenant_id', $idTenant)
            ->get();

        return $tables;
    }

    public function getTableByUuid(string $uuid)
    {

        $table = DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();

        return $table;
    }
}

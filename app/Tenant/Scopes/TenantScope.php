<?php

namespace App\Tenant\Scopes;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{

    /**
     * Scope global que permite filtrar pela empresa do usuario autenticado ou logado no sistema.
     * Depois de criado deve ser adicionado em Tenant/Traits/TenantTraits.php na função boot()
     */
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //Pega o tanant_id do usuario autenticado e passamos na variavel identify
        $identify = app(ManagerTenant::class)->getTenantId();

        //se identify diferente de vazio
        if ($identify) {
            //aplica o filtro pelo tenant_id com valor do identify
            $builder->where('tenant_id', $identify);
        }

        // $managerTenant = app(ManagerTenant::class);
        // $builder->where('tenant_id', $managerTenant->getTenantId());

        //ou
        //        $builder->where('tenant_id', app(ManagerTenant::class)->getTenantId());
    }
}

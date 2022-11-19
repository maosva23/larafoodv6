<?php

namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * TENANT OBSERVER GENERICO QUE ADICIONA AUTOMATICAMENTE O IDENTIFICADOR DA EMPRESA
     * A QUALQUER MODELO DA BASE DE DADOS QUE TEM RELAÇÃO COM A EMPRESA
     */

    /**
     * Handle the plan "creating" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        //cria um obejcto do tipo ManagetTenant.
        $managerTenant = app(ManagerTenant::class);

        //pega o valor do tenant_id e atribui a variavel identify
        $identify = $managerTenant->getTenantId();

        //se identify diferente de vazio
        if ($identify) {
            //aplica ao tenant_id o valor de identify
            $model->tenant_id = $identify;
        }
    }
}

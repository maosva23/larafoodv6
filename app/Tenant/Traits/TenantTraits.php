<?php

namespace App\Tenant\Traits;

use App\Tenant\Observers\TenantObserver;
use App\Tenant\Scopes\TenantScope;

trait TenantTraits
{
    /**
     * The "booting" method of the model.
     * Insere o tenant_id do usuario logado no tenant_id da categoria
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(TenantObserver::class);
        static::addGlobalScope(new TenantScope); //filtra pela empresa do usuario autenticado
    }
}


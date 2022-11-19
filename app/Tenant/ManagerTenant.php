<?php

namespace App\Tenant;


use App\Models\Tenant;
use phpDocumentor\Reflection\Types\Boolean;

class ManagerTenant
{
    //Trabalhar com usuario autenticados e nao autenticados(anonimos)

    //Retorna o id do tenant do usuario logado
    public function getTenantId()
    {
        /**
         * Verifica se o usuario esta autenticado
         * se estiver autenticado retorna o tenant_id do usuario logado
         * se nao retorna vazio.
         */
        return auth()->check() ? auth()->user()->tenant_id : '';
    }

    // Retorna a empresa do usuario logado
    public function getTenant(): Tenant
    {
        /**
         * Verifica se o usuario esta autenticado
         * se estiver autenticado retorna a empresa do usuario logado
         * se nao retorna vazio.
         */
        return auth()->check() ? auth()->user()->tenant : '';
    }

    //Verifica se o usuario logado é um super usuario e retorna verdadeiro ou falso
    public function isAdmin(): bool
    {
        //Verifica se o usuario logado é um super admin a partir do arquivo /config/tenant.php
        //que tem um array com os email dos super usuarios
        return in_array(auth()->user()->email, config('tenant.admins'));
    }
}

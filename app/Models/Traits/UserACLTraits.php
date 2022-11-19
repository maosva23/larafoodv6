<?php

namespace App\Models\Traits;


//use App\Models\Role;
use App\Models\Plan;
use App\Models\Tenant;

trait UserACLTraits
{

    /**
     * @return array Verifica o cruzamento das permissões do usuario quanto do plano e do cargo
     * e retorma apenas as permissões que existe tanto em plano com do cargo
     */
    public function permissionsUser(): array //Retorna um array
    {
//        dd('permissionUser');


        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();
        $permissions = [];

        foreach ($permissionsRole as $permission){
            if (in_array($permission, $permissionsPlan)){
                array_push($permissions, $permission);
            }
        }
//         dd($permissions);

        return $permissions;
    }


    //Retorna todas as permissoes do plano do usuario autenticado
    public function permissionsPlan(): array //Retorna um array
    {
        //Recupera o tenant do usuario logado
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
//        dd($tenant);

        //Recupera o plano do tenant do usuario logado
        $plan = $tenant->plan;
//        dd($plan->profiles);


        //Recupera todas as permissoes do usuario logado
        $permissions = [];
        foreach ($plan->profiles as $profile){
            foreach ($profile->permissions as $permission ){
                array_push($permissions, $permission->name);
            }
        }

//        dd($permissions);
        return $permissions;

    }




    //Recupera todas a permissoes de uma determinada funcao ou cargo(Roles) do usuario logado
    public function permissionsRole(): array //Retorna um array
    {
        $roles = $this->roles()->with('permissions')->get();
//        dd($roles);

        $permissions = [];

        foreach ($roles as $role){
            foreach ($role->permissions as $permission){
                array_push($permissions, $permission->name);
            }
        }

//        dd($permissions);
        return $permissions;
    }

    //Retorna true se o usuario logado tem determinada permissao
    public function hasPermissionsUser($permissionName): bool
    {
        return in_array($permissionName, $this->permissionsUser());
    }

    //Retorna true se o email do usuario logado existe no arquivo config/acl.php
    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

    //Retorna false se o email do usuario logado nao existe no arquivo config/acl.php
    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }

    /**
     * Depois de definidas as funções devemos aplicar no arquivo AuthServiceProvider.php para automatização
     */
}

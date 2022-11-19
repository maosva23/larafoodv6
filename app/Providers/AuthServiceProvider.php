<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Verifica se aplicacao esta rodando no modo console
        if ($this->app->runningInConsole()) {
            return;
        }

        //Recupera todas as permissoes da base de dados
        $permissions = Permission::all();
//        dd($permissions);

        //Verifica se as permissoes do usuario consta nas permissoes registadas
        foreach ($permissions as $permission){
            Gate::define($permission->name, function (User $user) use ($permission){
//                dd($user->permissionsUser());
                return $user->permissionsUser();
            });
        }

        //Retorna true se o usuario logado é dono do recurso (objecto) Generico para qualquer Model
        Gate::define('owner', function (User $user, $object) {
            return $user->id === $object->user_id;
        });

        //Verifica antes de qualquer uma das restrições e Retorna true se o usuario é um super usuario
        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}

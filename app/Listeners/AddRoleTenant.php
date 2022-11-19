<?php

namespace App\Listeners;

use App\Tenant\Events\TenantCreatedEvent;
use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddRoleTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TenantCreatedEvent $event)
    {
        //Pega o usuario
        $user = $event->user();

        //pega o primeiro cargo (role) da base de dados
        if (!$role = Role::all()->first()){
            return;
        }

        //adiciona na tabela pivo role_user o cargo ao novo usuario cadastrado
        $user->roles()->attach($role);

        return $user;
    }
}

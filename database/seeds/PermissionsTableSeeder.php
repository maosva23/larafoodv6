<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User
        Permission::create([
            'name'          =>  'Navegar Usuarios',
            'slug'          =>  'users.index',
            'description'   =>  'Lista e navega todos os usuarios do sistema'
        ]);

        Permission::create([
            'name'          =>  'Ver detalhe de Usuario',
            'slug'          =>  'users.show',
            'description'   =>  'Ver em detalhe cada usuario do sistema'
        ]);

        Permission::create([
            'name'          =>  'Edição de Usuarios',
            'slug'          =>  'users.edit',
            'description'   =>  'Editar qualquer dado de um usuario do sistema'
        ]);

        Permission::create([
            'name'          =>  'Eliminar Usuario',
            'slug'          =>  'users.destroy',
            'description'   =>  'Eliminar qualquer usuario do sistema'
        ]);

        //Roles
        Permission::create([
            'name'          =>  'Navegar Roles',
            'slug'          =>  'roles.index',
            'description'   =>  'Lista e navega todos as roles do sistema'
        ]);

        Permission::create([
            'name'          =>  'Ver detalhe da Role',
            'slug'          =>  'roles.show',
            'description'   =>  'Ver em detalhe cada função do sistema'
        ]);

        Permission::create([
            'name'          =>  'Create de Roles',
            'slug'          =>  'roles.create',
            'description'   =>  'Editar qualquer dado de uma role do sistema'
        ]);

        Permission::create([
            'name'          =>  'Edição de Roles',
            'slug'          =>  'roles.edit',
            'description'   =>  'Editar qualquer dado de uma role do sistema'
        ]);

        Permission::create([
            'name'          =>  'Eliminar Role',
            'slug'          =>  'roles.destroy',
            'description'   =>  'Eliminar qualquer role do sistema'
        ]);

        //Products
        Permission::create([
            'name'          =>  'Navegar Products',
            'slug'          =>  'products.index',
            'description'   =>  'Lista e navega todos as Produtos do sistema'
        ]);

        Permission::create([
            'name'          =>  'Ver detalhe da Product',
            'slug'          =>  'products.show',
            'description'   =>  'Ver em detalhe cada produto do sistema'
        ]);

        Permission::create([
            'name'          =>  'Create de Products',
            'slug'          =>  'products.create',
            'description'   =>  'Editar qualquer dado de um produto do sistema'
        ]);

        Permission::create([
            'name'          =>  'Edição de Products',
            'slug'          =>  'products.edit',
            'description'   =>  'Editar qualquer dado de um produto do sistema'
        ]);

        Permission::create([
            'name'          =>  'Eliminar Product',
            'slug'          =>  'products.destroy',
            'description'   =>  'Eliminar qualquer produto do sistema'
        ]);
    }
}

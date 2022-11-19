<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tenant = Tenant::first();

        //Insere o usuario com o id da Empresa a qual esta relacionado
        $tenant->users()->create([
            'name' => 'Osvaldo Lopes',
            'email' => 'osl@gmail.com',
            'password' => bcrypt('123456')
        ]);

//        User::create([
//            'name' => 'Osvaldo Lopes',
//            'email' => 'osl@gmail.com',
//            'password' => bcrypt('123456')
//        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'nif' => '2111084581',
            'name' => 'EspecializaTi',
            'url' => 'especializati',
            'email' => 'osl@gmail.com',
        ]);
    }
}

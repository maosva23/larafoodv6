<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Businers',
            'url' => 'businers',
            'price' => '499.99',
            'description' => 'Plano Empresarial',
        ]);

        Plan::create([
            'name' => 'Free',
            'url' => 'free',
            'price' => '00',
            'description' => 'Plano de free',
        ]);

        Plan::create([
            'name' => 'Premium',
            'url' => 'premium',
            'price' => '345.99',
            'description' => 'Plano Basico',
        ]);
    }
}

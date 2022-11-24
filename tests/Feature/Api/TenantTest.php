<?php

namespace Tests\Feature;

use App\Models\Tenant;
use Tests\TestCase;

class TenantTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * Get All Tenant.
     *
     * @return void
     */
    public function testGetAllTenants()
    {

        //Tenant::truncate();
        factory(Tenant::class, 10)->create();

        $response = $this->getJson('/api/v1/tenants');
        //$response->dump();

        $response->assertStatus(200)
                    ->assertJsonCount(10,'data');
    }

    /**
     * Test Get error single Tenant.
     *
     * @return void
     */
    public function testErrorGetTenant()
    {

        $tenant = 'fake_value';

        $response = $this->getJson("/api/v1/tenants/{$tenant}");
        //$response->dump();

        $response->assertStatus(404);
    }
}


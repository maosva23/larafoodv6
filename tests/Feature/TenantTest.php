<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test get all tenants.
     *
     * @return void
     */
    public function testGetAllTenants()
    {
        //factory(Tenant::class, 10)->create();
        $response = $this->getJson('/');


        $response->assertStatus(200);
    }
}

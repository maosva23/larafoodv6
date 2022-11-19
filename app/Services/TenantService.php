<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepositoryInterface;

//use Illuminate\Support\Str;

class TenantService
{
    private $plan, $data = [];
    private $repository;

    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTenants(int $per_page)
    {
        return $this->repository->getAllTenants($per_page);
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->repository->getTenantByUuid($uuid);
    }

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

//        dd($data);

        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);



        return $user;
    }

    public function storeTenant()
    {
        $data = $this->data;
//        dd($data);
        //passa automaticamente o plan_id atraves do relacionamento
        return $this->plan->tenants()->create([
            'nif' => $data['nif'],
            'name' => $data['empresa'],
            //'url' => Str::kebab($data['empresa']), //criado automaticamento pelo TenantObserver
            'email' => $data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);

    }

    public function storeUser($tenant)
    {//passa automaticamente o tenant_id atraves do relacionamento
        $user = $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        return $user;
    }
}

<?php

namespace App\Services;



//use Illuminate\Support\Str;

use App\Repositories\ClientRepositoryEloquent;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ClientService
{

    protected $clientRepositoryEloquent;

    public function __construct(
        ClientRepositoryEloquent $clientRepositoryEloquent

    )
    {
        $this->clientRepositoryEloquent = $clientRepositoryEloquent;

    }

    public function createNewClient(array $data)
    {
        return $this->clientRepositoryEloquent->createNewClient($data);
    }




}

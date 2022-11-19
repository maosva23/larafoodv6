<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;


class ClientRepositoryEloquent implements ClientRepositoryInterface
{
    protected $entity;

    public function __construct(Client $client)
    {
        $this->entity = $client;
    }


    public function createNewClient(array $data)
    {
        // TODO: Implement createNewClient() method.
        $data['password'] = bcrypt($data['password']);
        return $this->entity->create($data);
    }

    public function getClientByUuid(string $uuid)
    {
        // TODO: Implement getClient() method.
    }
}

<?php

namespace App\Services;



//use Illuminate\Support\Str;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TableRepositoryQueryBuilder;
use http\Env\Request;

class EvaluationService
{

    protected $evaluationRepositoryEloquent, $orderRepositoryEloquent;

    public function __construct(
        EvaluationRepositoryInterface $evaluationRepositoryEloquent,
        OrderRepositoryInterface $orderRepositoryEloquent
    )
    {
        $this->evaluationRepositoryEloquent = $evaluationRepositoryEloquent;
        $this->orderRepositoryEloquent = $orderRepositoryEloquent;

    }

    public function createNewEvaluation(string $identifyOrder, array $evaluation)
    {
        $clientId = $this->getIdClient();
        $order = $this->orderRepositoryEloquent->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepositoryEloquent->newEvaluationOrder($order->id, $clientId, $evaluation);
    }


    /**Recuperar o id do client auttenticado*/
    private function getIdClient()
    {
//        return request()->user()->id;
        return auth()->user()->id;
    }
}

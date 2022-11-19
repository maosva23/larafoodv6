<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request)
    {

        $order = $this->orderService->createNewOrder($request->all());

        return new OrderResource($order);
    }

    /**Recupera um pedido pelo identify*/
    public function show($identify)
    {

        $order = $this->orderService->getOrderByIdentify($identify);

        if (!$order){
            return response()->json(['message' => 'Not found'], 404);
        }

        return new OrderResource($order);
    }

    public function myOrders()
    {
        $orders = $this->orderService->orderByClient();

        return OrderResource::collection($orders);
    }
}

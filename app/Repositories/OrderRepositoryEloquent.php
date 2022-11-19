<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;


class OrderRepositoryEloquent implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }


    public function createNewOrder(string $identify, float $total, string $status, int $tenantId, string $comment = '', $clientId = '', $tableId = '')
    {
        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'tenant_id' => $tenantId,
            'comment' => $comment
//            'clientId' => $clientId,
//            'tableId' =>$tableId
        ];

        if ($clientId) $data['client_id'] = $clientId;
        if($tableId) $data['table_id'] = $tableId;


//        dd($data);


        $order = $this->entity->create($data);

        return $order;

    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity
            ->where('identify', $identify)
            ->first();
    }

    /**Regista na tabela pivo "order_product" os productos da ordem (pedido)*/
    public function registerProductsOrder(int $orderId, array $products)
    {
        /**Recuperar a ordem pelo id*/
        $order = $this->entity->find($orderId);

        $orderProducts = [];
        foreach ($products as $product){
            $orderProducts[$product['id']] = [
                'qty' => $product['qty'],
                'price' => $product['price'],
            ];
        }

        $order->products()->attach($orderProducts);



        /**Inserir pelo Query Builde utilizando da facade DB*/
//        $orderProducts = [];
//        foreach ($products as $product){
//            array_push($orderProducts, [
//                'order_id' => $orderId,
//                'product_id' => $product['id'],
//                'qty' => $product['qty'],
//                'price' => $product['price']
//            ]);
//        }
//        DB::table('order_product')->insert($orderProducts);
    }

    public function getOrdersByClienId(int $idclient)
    {
        $orders = $this->entity
                        ->where('client_id', $idclient)
                        ->paginate();
        return $orders;
    }
}

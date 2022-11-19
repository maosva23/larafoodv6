<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment = '',
        $clientId = '',
        $tableId = '');

    public function getOrderByIdentify(string $identify);

    /**Regista na tabela pivo "order_product" os productos da ordem (pedido)*/
    public function registerProductsOrder(int $orderId, array $products);

    public function getOrdersByClienId(int $idclient);


}

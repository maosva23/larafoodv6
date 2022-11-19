<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepositoryEloquent, $tenantRepository, $tableRepositoryQueryBuilder, $clientRepositoryEloquent, $productRepositoryQueryBuilder;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ClientRepositoryInterface $clientRepository,
        ProductRepositoryInterface $productRepository
)
    {
        $this->orderRepositoryEloquent = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepositoryQueryBuilder = $tableRepository;
        $this->clientRepositoryEloquent = $clientRepository;
        $this->productRepositoryQueryBuilder = $productRepository;
    }


    public function createNewOrder(array $order)
    {
        $productsOrder = $this->getProductsByOrder($order['products'] ?? []);


        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $identify = $this->getIdentifyOrder();
        $total = $this->getCalcTotalOrder($productsOrder);
        $status = 'open';
        $comment = isset($order['comment']) ? $order['comment']: '';
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');//se existir informa ele se não informa vazio


        $order = $this->orderRepositoryEloquent->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId
        );

        $this->orderRepositoryEloquent->registerProductsOrder($order->id, $productsOrder);

        return $order;
    }

    /*Gera ou cria um identificador unico para o pedido (Order)*/
    private function getIdentifyOrder(int $qtyCharactters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvxwxyz');
        $numbers = (((date('Ymd') / 12 * 24) + mt_rand(800, 900)));
        $numbers .= 1234567890;

//        $specialCharactters = str_shuffle('!"@$§%&/');
//        $charactters = $smallLetters.$numbers.$specialCharactters;
        $charactters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($charactters), 0, $qtyCharactters);

        /**Verifica se já existe o identificador caso retorna true gera outro identificador adicionando mais um caracter*/
        if ($this->orderRepositoryEloquent->getOrderByIdentify($identify)){
            $this->getIdentifyOrder($qtyCharactters + 1);
        }

        return $identify;

    }

    public function getProductsByOrder(array $productsOrder): array
    {
        $products = [];

        foreach ($productsOrder as $productOrder){
            /**Verifica os produtos da ordem na base de dados*/
            $product = $this->productRepositoryQueryBuilder->getProductByUuid($productOrder['identify']);

            /**Junta todos os produtos verificados em uma lista com os campos necessários*/
            array_push($products, [
               'id' => $product->id,
               'qty' => $productOrder['qty'],
               'price' => $product->price,
            ]);
        }


        return $products;
    }


    /*Retorna o total geral do pedido*/
    private function getCalcTotalOrder(array $products): float
    {
        $total = 0;
        foreach ($products as $product){
            $total += ($product['price'] * $product['qty']);
        }

        return (float) $total;
    }



    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
//        dd($tenant->id);
        return $tenant->id;
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if ($uuid){
            $table = $this->tableRepositoryQueryBuilder->getTableByUuid($uuid);
//            dd($table->id);
            return $table->id;
        }

        return '';

    }

    private function getClientIdByOrder()
    {
        $client = auth()->check() ? auth()->user()->id : '';

        return $client;

    }


    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepositoryEloquent->getOrderByIdentify($identify);
    }

    public function orderByClient()
    {
        $idClient = $this->getClientIdByOrder();

        return $this->orderRepositoryEloquent->getOrdersByClienId($idClient);
    }

}

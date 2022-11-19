<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryQueryBuilder;
use App\Repositories\ClientRepositoryEloquent;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\EvaluationRepositoryEloquent;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\ProductRepositoryQueryBuilder;
use App\Repositories\TableRepositoryQueryBuilder;
use App\Repositories\TenantRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepositoryQueryBuilder::class
        );

        $this->app->bind(TableRepositoryInterface::class,
            TableRepositoryQueryBuilder::class
        );

        $this->app->bind(ProductRepositoryInterface::class,
            ProductRepositoryQueryBuilder::class
        );

        $this->app->bind(ClientRepositoryInterface::class,
            ClientRepositoryEloquent::class);

        $this->app->bind(OrderRepositoryInterface::class,
            OrderRepositoryEloquent::class);

        $this->app->bind(EvaluationRepositoryInterface::class,
            EvaluationRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

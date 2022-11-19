<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use App\Observers\CategoryObserver;
use App\Observers\ClientObserver;
use App\Observers\PlanObserver;
use App\Observers\ProductObserver;
use App\Observers\TableObserver;
use App\Observers\TenantsObserver;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\TenantRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Registo do observer no service provider para que realiza ações do observer
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantsObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Table::observe(TableObserver::class);
        Client::observe(ClientObserver::class);

    }
}

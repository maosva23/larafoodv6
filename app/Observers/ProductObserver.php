<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Product $product)
    {
        $product->uuid = Str::uuid();
        $product->flag = Str::kebab($product->name);
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updating(Product $product)
    {
        $product->flag = Str::kebab($product->name);
    }


}

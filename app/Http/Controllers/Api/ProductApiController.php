<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function productsByTenant(TenantFormRequest $request)
    {

//        dd($request->token_company);
//        if (!$request->token_company){
//            return response()->json(['message' => 'token not found'], 404);
//        }

//        return response()->json($request->get('categories', []));//Debugar no Postman
        $products = $this->productService->getProductsByTenantUuid(
            $request->token_company,
            $request->get('categories', []) //
        );
        /**
         * ProductResource aonde definimos quais os campos que queremos retornar
         */
        return ProductResource::collection($products);
    }



    public function show(TenantFormRequest $request, $uuid)
    {
        $product = $this->productService->getProductByUuid($uuid);

        if (!$product){
            return response()->json(['message' => 'product not found'], 404);
        }
        return new ProductResource($product);
    }
}

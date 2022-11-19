<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function categoriesByTenant(TenantFormRequest $request)
    {

//        dd($request->token_company);
//        if (!$request->token_company){
//            return response()->json(['message' => 'token not found'], 404);
//        }
        $categories = $this->categoryService->getCategoriesByTenantUuid($request->token_company);

        return CategoryResource::collection($categories);
    }


    public function show(TenantFormRequest $request, $uuid)
    {
        $category = $this->categoryService->getCategoryByUuid($uuid);

        if (!$category){
            return response()->json(['message' => 'category not found'], 404);
        }
        return new CategoryResource($category);
    }


}

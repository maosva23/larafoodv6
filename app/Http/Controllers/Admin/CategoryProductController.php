<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;

        $this->middleware(['can:categorias']);

    }

    //Busca todas categorias de um determinado produto
    public function categoriesProduct($idProduct)
    {
//        $product = $this->product->with('categories')->find($idProduct);

        $product = $this->product->find($idProduct);

        if (!$product){
            return redirect()->back();
        }

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact('product', 'categories'));
    }

    //Busca todos os productos de uma determinada categoria
    public function productsCategory($idCategory){

        $category = $this->category->find($idCategory);

        if (!$category) {
            return redirect()->back();
        }

        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', compact('products','category'));


    }

    //Mostra
    public function categoriesProductCreate(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct)){
            return redirect()->back();
        }

        $filters = $request->except('_token');

//        $categories = $this->categories->paginate();
        //busca e mostra as caterias disponiveis de um determinado producto
        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('product', 'categories','filters'));


    }

    /**
     * Adicciona uma ou varias categorias a um determinado produto
     */
    public function categoriesProductAttach(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct)){
            return redirect()->back();
        }

//        dd(count($request->categories));

        if (!$request->categories || count($request->categories) == 0){
            return redirect()->back()
                ->with('info', 'Escolha pelo menos uma categoria');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('categories.product', $product->id);
    }

    /**
     * Disvincula category do produto
     */
    public function categoriesProductDettach($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if (!$product || !$category){
            return redirect()->back()->with('info', 'Registro não disponivel');
        }

        $product->categories()->detach($category);

        return redirect()->route('categories.product', $product->id);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTablesRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;

        $this->middleware(['can:mesas']);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->latest()->paginate();

        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTablesRequest $request)
    {
        $data = $request->all();
        $tenant = auth()->user()->tenant;

//        dd($data);

        // if ($request->hasFile('image') && $request->image->isValid()){
        //     $data['image'] = $request->image->store("tenants/{$tenant->uuid}/tables"); //upload da imagem
        // }

        $this->repository->create($data);

        return redirect()->route('tables.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTablesRequest $request, $id)
    {
        if (!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        $data = $request->all();
        $tenant = auth()->user()->tenant;

        // //Verifica se e um ficheiro e ao mesmo tempo se e valido
        // if ($request->hasFile('image') && $request->image->isValid()){

        //     //Verifica se existe a imagem, caso true elimina
        //     if (Storage::exists($table->image)){
        //         Storage::delete($table->image);
        //     }

        //     $data['image'] = $request->image->store("tenants/{$tenant->uuid}/tables");//upload da imagem
        // }

        $table->update($data);
        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        // //Verifica se existe a imagem, caso true elimina
        // if (Storage::exists($table->image)){
        //     Storage::delete($table->image);
        // }

        $table->delete();

        return redirect()->route('tables.index');
    }

    /**
     * Search result.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter'); //

        $tables = $this->repository
            ->where(function ($query) use ($request){
                if ($request->filter){
                    $query->where('identify', 'LIKE', "%{$request->filter}%");
                    $query->orwhere('description', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate(); //ou verificar outra forma no PlanController que tem o metodo search na model Plan

        return view('admin.pages.tables.index', compact('tables', 'filters'));
    }


    /**
     * Generate QRCode Table.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function qrcode($identify)
    {
        if (!$table = $this->repository->where('identify', $identify)->first()){
            return redirect()->back();
        }

        $tenant = auth()->user()->tenant;//Pega o tenant do usuario autenticado(client)

        /**Cria uma variavel uri pegado o valor da Constante URI_CLIENT do arquivo .env
         * concatenanto com o uuid do tenant e uuid do table
         */
        $uri = env('URI_CLIENT')."/{$tenant->uuid}/{$table->uuid}";

        return view('admin.pages.tables.qrcode', compact('uri'));
    }
}

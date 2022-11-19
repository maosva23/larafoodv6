<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenantRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;

        $this->middleware(['can:tenants']);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenantRequest $request)
    {
        $data = $request->all();
        $tenant = auth()->user()->tenant;

        if ($request->hasFile('logo') && $request->logo->isValid()){
            $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}/tenants"); //upload da imagem
        }

        $this->repository->create($data);

        return redirect()->route('tenants.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$tenant = $this->repository->with('plan')->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$tenant = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenantRequest $request, $id)
    {
        // dd($request->all());
        if (!$tenant = $this->repository->find($id)){
            return redirect()->back();
        }

        $data = $request->all();
        // $tenant = auth()->user()->tenant;

        //Verifica se e um ficheiro e ao mesmo tempo se e valido
        if ($request->hasFile('logo') && $request->logo->isValid()){

            //Verifica se existe a imagem, caso true elimina
//            if (Storage::exists($tenant->logo)){
//                Storage::delete($tenant->logo);
//            }

            $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}/tenants");//upload da imagem
        }

        $tenant->update($data);
        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tenant = $this->repository->find($id)){
            return redirect()->back();
        }

        //Verifica se existe a imagem, caso true elimina
        if (Storage::exists($tenant->logo)){
            Storage::delete($tenant->logo);
        }

        $tenant->delete();

        return redirect()->route('tenants.index');
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

        $tenants = $this->repository
            ->where(function ($query) use ($request){
                if ($request->filter){
                    $query->where('name', 'LIKE', "%{$request->filter}%");
                    $query->orwhere('nif', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate(); //ou verificar outra forma no PlanController que tem o metodo search na model Plan

        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }
}

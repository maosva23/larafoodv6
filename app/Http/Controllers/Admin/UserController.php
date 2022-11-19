<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;

        $this->middleware(['can:usuarios']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserRequest $request)
    {
        //Recuperar o tennat do usuario logado
//        $tenant = auth()->user()->tenant;
//        dd($request->all());
        $data = $request->all();
//        $data['tenant_id'] = $tenant->tenant_id;
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->tenantUser()->find($id);

        if (!$user){
            return redirect()->back();
        }

        return view('admin.pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserRequest $request, $id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }
        $data = $request->only(['name','email']);

        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('users.index')->with('message', 'Registo apagado com sucesso');
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

        $users = $this->repository
            ->where(function ($query) use ($request){
                if ($request->filter){
                    $query->where('name', 'LIKE', "%{$request->filter}%");
                    $query->orwhere('email', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->tenantUser()
            ->paginate(); //ou verificar outra forma no PlanController que tem o metodo search na model Plan

        return view('admin.pages.user.index', compact('users', 'filters'));
    }
}

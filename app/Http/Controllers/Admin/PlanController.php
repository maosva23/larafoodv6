<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        $this->middleware(['can:planos']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd('estou aqui');
        $plans = $this->repository->paginate();

        return view('admin.pages.plan.index', compact('plans'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePlanRequest $request)
    {
        $this->repository->create($request->all()); //O campo url é gerado pela classe PlanObserver pelo metodo creating()

        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        if (!$plan){
            return redirect()->back();
        }

        return view('admin.pages.plan.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan){
            return redirect()->back();
        }

        return view('admin.pages.plan.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePlanRequest $request, $url)
    {
        $plan = $this->repository->where('url',$url)->first();

        if (!$plan){
            return redirect()->back();
        }

        /** O campo url é gerado pela classe PlanObserver pelo metodo updating()
         *
         */
        $plan->update($request->all());

        return redirect()->route('plans.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $plan = $this->repository
            ->with('details')
            ->where('url', $url)->first();

        if (!$plan){
            return redirect()->back();
        }

        if ($plan->details->count() > 0){//verifica se existe um ou mais detalhe vinculado plano.
            return redirect()
                ->back()
                ->with('error', 'Existem detalhes vinculados a esse plano, portanto não pode deletar');
        }

        $plan->delete();

        return redirect()->route('plans.index')->with('message', 'Registo apagado com sucesso');
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

        $plans = $this->repository
            ->where(function ($query) use ($request){
                if ($request->filter){
                    $query->where('name', 'LIKE', "%{$request->filter}%");
                    $query->orwhere('description', 'LIKE', "%{$request->filter}%");
                }
            })
            ->paginate(); //ou verificar outra forma no PlanController que tem o metodo search na model Plan

        return view('admin.pages.plan.index', compact('plans', 'filters'));
    }
}

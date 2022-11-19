<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlanRequest;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;

        $this->middleware(['can:planos']);
    }


    public function index($urlPlan)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();

        if (!$plan){
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plan.details.index', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }

    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }
        return view('admin.pages.plan.details.create', compact('plan'));
    }

    public function store(StoreUpdateDetailPlanRequest $request, $urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        // $data = $Request->all();
        // $data['plan_id'] = $plan->id;
        // dd($data['plan_id']);
        // $this->repository->create($data);

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $urlPlan);
    }

    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first(); //Recupera o plano pela url
        $detail = $this->repository->find($idDetail); //Recupera o detalhe do plano pelo idDetalhe

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plan.details.edit', compact('plan', 'detail'));
    }

    public function update(StoreUpdateDetailPlanRequest $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first(); //Recupera o plano pela url
        $detail = $this->repository->find($idDetail); //Recupera o detalhe do plano pelo idDetalhe

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        // dd($request->all());

        $detail->update($request->all());

        return redirect()->route('details.plan.index', $urlPlan);
    }



    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first(); //Recupera o plano pela url
        $detail = $this->repository->find($idDetail); //Recupera o detalhe do plano pelo idDetalhe

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plan.details.show', compact('plan', 'detail'));
    }



    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first(); //Recupera o plano pela url
        $detail = $this->repository->find($idDetail); //Recupera o detalhe do plano pelo idDetalhe

        // dd($detail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->delete();

        return redirect()
            ->route('details.plan.index', $urlPlan)
            ->with('message', 'Registro apagado com sucesso');
    }
}

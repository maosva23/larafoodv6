<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilePlanController extends Controller
{
    /**
     * @var Plan, Profile
     */
    protected $plan, $profile;

    /**
     * ProfilePlanController constructor.
     * @param Plan $plan
     * @param Profile $profile
     */
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function profilesPlan($idPlan)
    {
        $plan = $this->plan->find($idPlan);

        if (!$plan){
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();
        return view('admin.pages.plan.profiles.profiles', compact('plan', 'profiles'));
    }

    public function profilesPlanCreate(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }

        $filters = $request->except('_token');

//        $permissions = $this->permission->paginate();
        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plan.profiles.available', compact('plan', 'profiles','filters'));


    }

    /**
     * Adicciona um ou varios perfis ao plano
     */
    public function ProfilesPlanAttach(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)){
            return redirect()->back();
        }

//        dd(count($request->permissions));

        if (!$request->profiles || count($request->profiles) == 0){
            return redirect()->back()
                ->with('info', 'Escolha pelo menos um Perfil');
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('profiles.plan', $plan->id);
    }

    /**
     * Disvincula perfil do plano
     */
    public function profilesPlanDettach($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if (!$plan || !$profile){
            return redirect()->back()->with('info', 'Registro não disponivel');
        }

        $plan->profiles()->detach($profile);

        return redirect()->route('profiles.plan', $plan->id);
    }
}

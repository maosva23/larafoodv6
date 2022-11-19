<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    /**
     * @param $idProfile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * Devolve todas as permissões de um perfil
     */
    public function permissionsProfile($idProfile)
    {
//        $profile = $this->profile->with('permissions')->find($idProfile);

        $profile = $this->profile->find($idProfile);

        if (!$profile){
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }

    /**
     * @param $idPermission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * Devolve todos os perfis de uma permissão
     */
    public function profilesPermission($idPermission){

        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('permission','profiles'));


    }

    /**
     * @param Request $request
     * @param $idProfile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * Devolve o formulario por tabela que permite selecionar uma ou varias permissões para vincular ao perfil
     */
    public function PermissionsProfileCreate(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $filters = $request->except('_token');

//        $permissions = $this->permission->paginate();
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions','filters'));


    }

    /**
     * Adicciona uma ou varias permissoes ao perfil
     */
    public function PermissionsProfileAttach(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

//        dd(count($request->permissions));

        if (!$request->permissions || count($request->permissions) == 0){
            return redirect()->back()
                ->with('info', 'Escolha pelo menos uma permissao');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('permissions.profile', $profile->id);
    }

    /**
     * Disvincula permissao do perfil
     */
    public function PermissionsProfileDettach($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission){
            return redirect()->back()->with('info', 'Registro não disponivel');
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('permissions.profile', $profile->id);
    }
}

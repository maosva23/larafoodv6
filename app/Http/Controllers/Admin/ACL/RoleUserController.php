<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function rolesUser($idUser)
    {
//        $user = $this->user->with('roles')->find($idUser);

        $user = $this->user->find($idUser);

        if (!$user){
            return redirect()->back();
        }

        $roles = $user->roles()->paginate();

        return view('admin.pages.user.roles.roles', compact('user', 'roles'));
    }

    public function usersRole($idRole){

        $role = $this->role->find($idRole);

        if (!$role) {
            return redirect()->back();
        }

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', compact('role','users'));


    }

    public function rolesUserCreate(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)){
            return redirect()->back();
        }

        $filters = $request->except('_token');

//        $roles = $this->role->paginate();
        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.user.roles.available', compact('user', 'roles','filters'));


    }

    /**
     * Adicciona uma ou varias permissoes ao perfil
     */
    public function rolesUserAttach(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)){
            return redirect()->back();
        }

//        dd(count($request->roles));

        if (!$request->roles || count($request->roles) == 0){
            return redirect()->back()
                ->with('info', 'Escolha pelo menos uma permissao');
        }

        $user->roles()->attach($request->roles);

        return redirect()->route('roles.user', $user->id);
    }

    /**
     * Disvincula permissao do perfil
     */
    public function rolesUserDettach($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if (!$user || !$role){
            return redirect()->back()->with('info', 'Registro não disponivel');
        }

        $user->roles()->detach($role);

        return redirect()->route('roles.user', $user->id);
    }
}

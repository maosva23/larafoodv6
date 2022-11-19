<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function permissionsRole($idRole)
    {
//        $role = $this->role->with('permissions')->find($idRole);

        $role = $this->role->find($idRole);

        if (!$role){
            return redirect()->back();
        }

        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions'));
    }

    public function rolesPermission($idPermission){

        $permission = $this->permission->find($idPermission);

        if (!$permission) {
            return redirect()->back();
        }

        $roles = $permission->roles()->paginate();

        return view('admin.pages.permissions.roles.roles', compact('permission','roles'));


    }

    public function PermissionsRoleCreate(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole)){
            return redirect()->back();
        }

        $filters = $request->except('_token');

//        $permissions = $this->permission->paginate();
        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions','filters'));


    }

    /**
     * Adicciona uma ou varias permissoes a funcao
     */
    public function PermissionsRoleAttach(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole)){
            return redirect()->back();
        }

//        dd(count($request->permissions));

        if (!$request->permissions || count($request->permissions) == 0){
            return redirect()->back()
                ->with('info', 'Escolha pelo menos uma permissao');
        }

        $role->permissions()->attach($request->permissions);

        return redirect()->route('permissions.role', $role->id);
    }

    /**
     * Disvincula permissao do funcao
     */
    public function PermissionsRoleDettach($idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission){
            return redirect()->back()->with('info', 'Registro não disponivel');
        }

        $role->permissions()->detach($permission);

        return redirect()->route('permissions.role', $role->id);
    }
}

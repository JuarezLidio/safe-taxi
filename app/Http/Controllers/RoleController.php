<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Services\TreeBuilderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{

    public function __construct(private TreeBuilderService $treeBuilderService){
    }

    public function index(Role $roles)
    {
        return Inertia::render('Roles/Index', ['roles'=> $roles->all()]);
    }

    public function create(Role $roles)
    {
        return Inertia::modal('Roles/Create')->baseRoute("roles.index", $roles);
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());

        $role->permissions()->attach(1);
        $role->menus()->attach(1);

        return redirect()->route('roles.index')->with('message', 'Rol creado con éxito');
    }

    public function show(Role $role)
    {
        return Inertia::modal('Roles/Show')->with(['role' => $role,])->baseRoute("roles.index", $role);
    }

    public function edit(Role $role)
    {
        return Inertia::modal('Roles/Edit')->with(['role' => $role,])->baseRoute("roles.index", $role);
    }

    public function update(Role $role, UpdateRoleRequest $request)
    {
        $role->update($request->all());

        return redirect()->route('roles.index')->with('message', 'Rol actualizado con éxito');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('message', 'Rol eliminado con éxito');
    }

    public function trash(Role $roles)
    {
        return Inertia::render('Roles/Trash', ['roles'=> $roles->onlyTrashed()->get()]);
    }

    public function restore(Role $role)
    {
        $role->restore();

        return redirect()->route('roles.trash')->with('message', 'Rol restaurado con éxito');
    }

    public function drop(Role $role)
    {
        $role->permissions()->detach();
        $role->menus()->detach();

        $role->forceDelete();

        return redirect()->route('roles.trash')->with('message', 'Rol eliminado completamente con éxito');
    }

    public function restoreAll(Role $roles)
    {
        $roles->onlyTrashed()->restore();

        return redirect()->route('roles.trash')->with('message', 'Roles restaurados con éxito');
    }

    public function dropAll(Role $roles)
    {
        foreach($roles->onlyTrashed()->get() as $role){
            $role->permissions()->detach();
            $role->menus()->detach();
        }

        $roles->onlyTrashed()->forceDelete();

        return redirect()->route('roles.trash')->with('message', 'Roles eliminados completamente con éxito');
    }

    public function indexRelationship(Role $roles)
    {
        foreach ($roles->with('permissions')->with('menus')->get() as $role) {
            $rolesPermissions[] = $this->treeBuilderService->buildTree($role->permissions->toArray());
            $rolesMenus[] = $this->treeBuilderService->buildTree($role->menus->toArray());
        }

        return Inertia::render('Roles/IndexRelationship', ['roles' => $roles->all(), 'rolesPermissions' => $rolesPermissions, 'rolesMenus' => $rolesMenus]);
    }

    public function editRelationship(Role $role, Permission $permissions, Menu $menus)
    {
        return Inertia::render('Roles/EditRelationship', ['role' => $role, 'rolePermission' => $this->treeBuilderService->buildTree($role->permissions->toArray()), 'roleMenu' => $this->treeBuilderService->buildTree($role->menus->toArray()), 'permissions' => $this->treeBuilderService->buildTree($permissions->all()->toArray()), 'menus' => $this->treeBuilderService->buildTree($menus->all()->toArray())]);
    }

    public function updateRelationship(Role $role, Request $request)
    {
        $role->permissions()->detach();
        $role->permissions()->attach(1);
        $role->permissions()->attach($request->alias);

        $role->menus()->detach();
        $role->menus()->attach(1);
        $role->menus()->attach($request->name);

        return redirect()->route('roles.indexRelationship')->with('message', 'Roles, Permisos y Menús actualizados con éxito');
    }
}

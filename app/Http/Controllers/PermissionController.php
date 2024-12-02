<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function index(Permission $permission)
    {
        return Inertia::render('Permissions/Index', ['permissions'=> $permission->with('permission_self')->get()]);
    }

    public function create(Permission $permissions)
    {
        return Inertia::modal('Permissions/Create', ['permissions'=> $permissions->where('id_parent', 1)->get()])->baseRoute("permissions.index", $permissions);
    }

    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->all());

        return redirect()->route('permissions.index')->with('message', 'Permiso creado con éxito');
    }

    public function show(Permission $permission)
    {
        return Inertia::modal('Permissions/Show')->with(['permission' => $permission->with('permission_self')->where('id', $permission->id)->first()])->baseRoute("permissions.index", $permission);
    }

    public function edit(Permission $permission)
    {
        return Inertia::modal('Permissions/Edit')->with(['permission' => $permission->with('permission_self')->where('id', $permission->id)->first(), 'permissions'=>$permission->where('id_parent', 1)->whereNotIn('id', [$permission->id])->get()])->baseRoute("permissions.index", $permission);
    }

    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('message', 'Permiso actualizado con éxito');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('message', 'Permiso eliminado con éxito');
    }

    public function trash(Permission $permissions)
    {
        return Inertia::render('Permissions/Trash', ['permissions'=> $permissions->with('permission_self')->onlyTrashed()->get()]);
    }

    public function restore(Permission $permission)
    {
        $permission->restore();

        return redirect()->route('permissions.trash')->with('message', 'Permiso restaurado con éxito');
    }

    public function drop(Permission $permission)
    {
        $permission->forceDelete();

        return redirect()->route('permissions.trash')->with('message', 'Permiso eliminado completamente con éxito');
    }

    public function restoreAll(Permission $permissions)
    {
        $permissions->onlyTrashed()->restore();

        return redirect()->route('permissions.trash')->with('message', 'Permisos restaurados con éxito');
    }

    public function dropAll(Permission $permissions)
    {
        $permissions->onlyTrashed()->forceDelete();

        return redirect()->route('permissions.trash')->with('message', 'Permisos eliminados completamente con éxito');
    }
}

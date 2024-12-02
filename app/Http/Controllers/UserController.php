<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(User $users)
    {
        return Inertia::render('Users/Index', ['users'=> $users->with('roles')->get()]);
    }

    public function create(User $users, Role $roles)
    {
        return Inertia::modal('Users/Create', ['roles'=> $roles->all()])->baseRoute("users.index", $users);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->all());

        return redirect()->route('users.index')->with('message', 'Usuario creado con éxito');
    }

    public function show(User $user)
    {
        return Inertia::modal('Users/Show')->with(['user' => $user->with('roles')->where('id', $user->id)->first()])->baseRoute("users.index", $user);
    }

    public function edit(User $user, Role $roles)
    {
        return Inertia::modal('Users/Edit')->with(['user' => $user->with('roles')->where('id', $user->id)->first(), 'roles'=> $roles->all()])->baseRoute("users.index", $user);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->all());

        return redirect()->route('users.index')->with('message', 'Usuario actualizado con éxito');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('message', 'Usuario eliminado con éxito');
    }

    public function trash(User $users)
    {
        return Inertia::render('Users/Trash', ['users'=> $users->with('roles')->onlyTrashed()->get()]);
    }

    public function restore(User $user)
    {
        $user->restore();

        return redirect()->route('users.trash')->with('message', 'Usuario restaurado con éxito');
    }

    public function drop(User $user)
    {
        $user->forceDelete();

        return redirect()->route('users.trash')->with('message', 'Usuario eliminado completamente con éxito');
    }

    public function restoreAll(User $users)
    {
        $users->onlyTrashed()->restore();

        return redirect()->route('users.trash')->with('message', 'Usuarios restaurados con éxito');
    }

    public function dropAll(User $users)
    {
        $users->onlyTrashed()->forceDelete();

        return redirect()->route('users.trash')->with('message', 'Usuarios eliminados completamente con éxito');
    }
}

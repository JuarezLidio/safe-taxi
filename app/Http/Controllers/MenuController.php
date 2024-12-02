<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index(Menu $menu)
    {
        return Inertia::render('Menus/Index', ['menus' => $menu->with('menu_self')->get()]);
    }

    public function create(Menu $menus)
    {
        return Inertia::modal('Menus/Create', ['menus' => $menus->where('id_parent', 1)->get()])->baseRoute("menus.index", $menus);
    }

    public function store(StoreMenuRequest $request)
    {
        Menu::create($request->all());

        return redirect()->route('menus.index')->with('message', 'Menú creado con éxito');
    }

    public function show(Menu $menu)
    {
        return Inertia::modal('Menus/Show')->with(['menu' => $menu->with('menu_self')->where('id', $menu->id)->first()])->baseRoute("menus.index", $menu);
    }

    public function edit(Menu $menu)
    {
        return Inertia::modal('Menus/Edit')->with(['menu' => $menu->with('menu_self')->where('id', $menu->id)->first(), 'menus' => $menu->where('id_parent', 1)->whereNotIn('id', [$menu->id])->get()])->baseRoute("menus.index", $menu);
    }

    public function update(Menu $menu, UpdateMenuRequest $request)
    {
        $menu->update($request->all());

        return redirect()->route('menus.index')->with('message', 'Menú actualizado con éxito');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('message', 'Menú eliminado con éxito');
    }

    public function trash(Menu $menus)
    {
        return Inertia::render('Menus/Trash', ['menus' => $menus->with('menu_self')->onlyTrashed()->get()]);
    }

    public function restore(Menu $menu)
    {
        $menu->restore();

        return redirect()->route('menus.trash')->with('message', 'Menú restaurado con éxito');
    }

    public function drop(Menu $menu)
    {
        $menu->forceDelete();

        return redirect()->route('menus.trash')->with('message', 'Menú eliminado completamente con éxito');
    }

    public function restoreAll(Menu $menus)
    {
        $menus->onlyTrashed()->restore();

        return redirect()->route('menus.trash')->with('message', 'Menús restaurados con éxito');
    }

    public function dropAll(Menu $menus)
    {
        $menus->onlyTrashed()->forceDelete();

        return redirect()->route('menus.trash')->with('message', 'Menús eliminados completamente con éxito');
    }
}

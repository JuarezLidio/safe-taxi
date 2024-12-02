<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use Inertia\Inertia;

class DriverController extends Controller
{
    public function index(Driver $driver)
    {
        return Inertia::render('Drivers/Index', ['drivers'=> $driver->get()]);
    }

    public function create(Driver $drivers)
    {
        return Inertia::modal('Drivers/Create', ['driver' => $drivers->get()])->baseRoute("drivers.index", $drivers);
    }

    public function store(StoreDriverRequest $request)
    {
        Driver::create($request->except('originalPhoto'));

        return redirect()->route('drivers.index')->with('message', 'Conductor creado con éxito');
    }

    public function show(Driver $driver)
    {
        return Inertia::modal('Drivers/Show')->with(['driver' => $driver,])->baseRoute("drivers.index", $driver);
    }

    public function edit(Driver $driver)
    {
        return Inertia::modal('Drivers/Edit')->with(['driver' => $driver,])->baseRoute("drivers.index", $driver);
    }

    public function update(Driver $driver, UpdateDriverRequest $request)
    {
        $driver->update($request->except('changedPhoto'));

        return redirect()->route('drivers.index')->with('message', 'Conductor actualizado con éxito');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('drivers.index')->with('message', 'Conductor eliminado con éxito');
    }

    public function trash(Driver $drivers)
    {
        return Inertia::render('Drivers/Trash', ['drivers' => $drivers->onlyTrashed()->get()]);
    }

    public function restore(Driver $driver)
    {
        $driver->restore();

        return redirect()->route('drivers.trash')->with('message', 'Conductor restaurado con éxito');
    }

    public function drop(Driver $driver)
    {
        $driver->forceDelete();

        return redirect()->route('drivers.trash')->with('message', 'Conductor eliminado completamente con éxito');
    }

    public function restoreAll(Driver $drivers)
    {
        $drivers->onlyTrashed()->restore();

        return redirect()->route('drivers.trash')->with('message', 'Conductores restaurados con éxito');
    }

    public function dropAll(Driver $drivers)
    {
        $drivers->onlyTrashed()->forceDelete();

        return redirect()->route('drivers.trash')->with('message', 'Conductores eliminados completamente con éxito');
    }
}

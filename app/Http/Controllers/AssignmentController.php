<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Driver;
use App\Models\Transport;
use Inertia\Inertia;


class AssignmentController extends Controller
{
    public function index(Assignment $assignment)
    {
        return Inertia::render('Assignments/Index', ['assignments'=> $assignment->with('drivers','transports')->get()]);
    }
    public function create(Assignment $assignments)
    {
    $drivers = Driver::all();
    $transports = Transport::all();
    return Inertia::modal('Assignments/Create', ['drivers' => $drivers,'transports' => $transports,'assignment' => $assignments->get()])->baseRoute("assignments.index", $assignments);
    }
    public function store(StoreAssignmentRequest $request)
    {
        Assignment::create($request->all());

        return redirect()->route('assignments.index')->with('message', 'Asignación creado correctamente');
    }
    public function show(Assignment $assignment)
    {
        $assignment->load('drivers', 'transports');
        return Inertia::modal('Assignments/Show')->with(['assignment' => $assignment])->baseRoute('assignments.index', $assignment);
    }
    public function edit(Assignment $assignment)
    {
            $assignment->load('drivers', 'transports');
            return Inertia::modal('Assignments/Edit')->with([
                'assignment' => $assignment,
                'drivers' => Driver::all()->map(fn($driver) => ['label' => $driver->full_name . ' ' . $driver->surnames, 'value' => $driver->id]),
                'transports' => Transport::all()->map(fn($transport) => ['label' => $transport->economic_number, 'value' => $transport->id]),
            ])->baseRoute('assignments.index', $assignment);
    }
    public function update(Assignment $assignment, UpdateAssignmentRequest $request)
    {
        $assignment->update($request->all());

        return redirect()->route('assignments.index')->with('message', 'Asignación actualizado con éxito');
    }
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignments.index')->with('message', 'Asignación eliminado con éxito');
    }
    public function trash(Assignment $assignments)
    {
        return Inertia::render('Assignments/Trash', ['assignments' => $assignments->with('drivers','transports')->onlyTrashed()->get()]);
    }

    public function restore(Assignment $assignment)
    {
        $assignment->restore();

        return redirect()->route('assignments.trash')->with('message', 'Asignación restaurado con éxito');
    }

    public function drop(Assignment $assignment)
    {
        $assignment->forceDelete();

        return redirect()->route('assignments.trash')->with('message', 'Asignación eliminado completamente con éxito');
    }

    public function restoreAll(Assignment $assignments)
    {
        $assignments->onlyTrashed()->restore();

        return redirect()->route('assignments.trash')->with('message', 'Asignaciones restaurados con éxito');
    }

    public function dropAll(Assignment $assignments)
    {
        $assignments->onlyTrashed()->forceDelete();

        return redirect()->route('assignments.trash')->with('message', 'Asignaciones eliminados completamente con éxito');
    }
}

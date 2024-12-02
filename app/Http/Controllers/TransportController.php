<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransportRequest;
use App\Http\Requests\UpdateTransportRequest;
use App\Models\Transport;
use Inertia\Inertia;

class TransportController extends Controller
{
    public function index(Transport $transport)
    {
        return Inertia::render('Transports/Index', ['transports'=> $transport->get()]);
    }
    public function create(Transport $transports)
    {
        return Inertia::modal('Transports/Create', ['transport' => $transports->get()])->baseRoute("transports.index", $transports);
    }
 function store(StoreTransportRequest $request)
    {
        Transport::create($request->all());

        return redirect()->route('transports.index')->with('message', 'Vehículo creado correctamente');
    }
    public function show(Transport $transport)
    {
        return Inertia::modal('Transports/Show')->with(['transport' => $transport,])->baseRoute("transports.index", $transport);

    }
    public function edit(Transport $transport)
    {
        return Inertia::modal('Transports/Edit')->with(['transport' => $transport,])->baseRoute("transports.index", $transport);
    }
    public function update(Transport $transport, UpdateTransportRequest $request)
    {
        $transport->update($request->all());

        return redirect()->route('transports.index')->with('message', 'Vehiculo actualizado con éxito');
    }
    public function destroy(Transport $transport)
    {
        $transport->delete();

        return redirect()->route('transports.index')->with('message', 'Vehiculo eliminado con éxito');
    }
    public function trash(Transport $transports)
    {
        return Inertia::render('Transports/Trash', ['transports' => $transports->onlyTrashed()->get()]);
    }

    public function restore(Transport $transport)
    {
        $transport->restore();

        return redirect()->route('transports.trash')->with('message', 'Vehiculo restaurado con éxito');
    }

    public function drop(Transport $transport)
    {
        $transport->forceDelete();

        return redirect()->route('transports.trash')->with('message', 'Vehiculo eliminado completamente con éxito');
    }

    public function restoreAll(Transport $transports)
    {
        $transports->onlyTrashed()->restore();

        return redirect()->route('transports.trash')->with('message', 'Vehiculo restaurados con éxito');
    }

    public function dropAll(Transport $transports)
    {
        $transports->onlyTrashed()->forceDelete();

        return redirect()->route('transports.trash')->with('message', 'Vehiculo eliminados completamente con éxito');
    }
}

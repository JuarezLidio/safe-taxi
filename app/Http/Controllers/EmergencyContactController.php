<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmergencyContactRequest;
use App\Http\Requests\UpdateEmergencyContactRequest;
use App\Models\EmergencyContact;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;


class EmergencyContactController extends Controller
{
    public function index(EmergencyContact $emergencyContacts)
    {
        return Inertia::render('EmergencyContacts/Index', ['emergencyContacts' => $emergencyContacts->with('users')->get()]);
    }

    public function create(EmergencyContact $emergencyContact)
    {
        return Inertia::modal('EmergencyContacts/Create')->baseRoute("emergency_contacts.index",$emergencyContact);
    }

    public function store(StoreEmergencyContactRequest $request)
    {
        EmergencyContact::create($request->all());

        return redirect()->route('profile.show')->with('message', 'Contacto de emergencia creado con éxito');
    }

    public function show(EmergencyContact $emergencyContact)
    {
        return Inertia::modal('EmergencyContacts/Show')->with(['emergencyContacts' => $emergencyContact->with('users')->where('id', $emergencyContact->id)->first()])->baseRoute("emergency_contacts.index", $emergencyContact);
    }

    public function edit(EmergencyContact $emergencyContact)
    {
        return Inertia::modal('EmergencyContacts/Edit')->with(['emergencyContacts' => $emergencyContact->with('users')->where('id', $emergencyContact->id)->first()])->baseRoute("emergency_contacts.index",$emergencyContact);
    }

    public function update(UpdateEmergencyContactRequest $request, EmergencyContact $emergencyContact)
    {
        $emergencyContact->update($request->all());

        return redirect()->route('profile.show')->with('message', 'Contacto de emergencia actualizado con éxito');
    }

    public function destroy(EmergencyContact $emergencyContact)
    {
        $emergencyContact->delete();
    }

    public function trash(EmergencyContact $emergencyContact)
    {
        return Inertia::render('EmergencyContacts/Trash', ['emergencyContact'=> $emergencyContact->with('users')->onlyTrashed()->get()]);
    }

    public function restore(EmergencyContact $emergencyContact)
    {
        $emergencyContact->restore();

        return redirect()->route('emergency_contacts.trash')->with('message', 'Contacto de emergencia restaurado con éxito');
    }

    public function drop(EmergencyContact $emergencyContact)
    {
        $emergencyContact->forceDelete();

        return redirect()->route('emergency_contacts.trash')->with('message', 'Contacto de emergencia eliminado completamente con éxito');
    }

    public function restoreAll(EmergencyContact $emergencyContact)
    {
        $emergencyContact->onlyTrashed()->restore();

        return redirect()->route('emergency_contacts.trash')->with('message', 'Contactos de emergencia restaurados con éxito');
    }

    public function dropAll(EmergencyContact $emergencyContact)
    {
        $emergencyContact->onlyTrashed()->forceDelete();

        return redirect()->route('emergency_contacts.trash')->with('message', 'Contactos de emergencia eliminados completamente con éxito');
    }
}

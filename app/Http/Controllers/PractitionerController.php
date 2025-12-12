<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Models\Status;
use App\Models\Speciality;
use App\Models\SubSpeciality;
use Illuminate\Http\Request;

class PractitionerController extends Controller
{
    public function index()
    {
        $practitioners = Practitioner::with(['status', 'speciality', 'subSpeciality'])
            ->latest()
            ->paginate(10);
        
        return view('practitioners.index', compact('practitioners'));
    }

    public function create()
    {
        $statuses = Status::all();
        $specialities = Speciality::all();
        $subSpecialities = SubSpeciality::all();
        
        return view('practitioners.create', compact('statuses', 'specialities', 'subSpecialities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|unique:practitioners|max:50',
            'full_name' => 'required|max:255',
            'status_id' => 'required|exists:statuses,id',
            'speciality_id' => 'nullable|exists:specialities,id',
            'sub_speciality_id' => 'nullable|exists:sub_specialities,id',
            'address' => 'nullable|string',
            'profile_link' => 'nullable|url',
        ]);

        Practitioner::create($request->all());

        return redirect()->route('practitioners.index')
            ->with('success', 'Practitioner created successfully.');
    }

    public function show(Practitioner $practitioner)
    {
        $practitioner->load([
            'status',
            'speciality',
            'subSpeciality',
            'contacts',
            'qualifications.degree',
            'qualifications.institution',
            'licenses'
        ]);
        
        return view('practitioners.show', compact('practitioner'));
    }

    public function edit(Practitioner $practitioner)
    {
        $statuses = Status::all();
        $specialities = Speciality::all();
        $subSpecialities = SubSpeciality::all();
        
        return view('practitioners.edit', compact('practitioner', 'statuses', 'specialities', 'subSpecialities'));
    }

    public function update(Request $request, Practitioner $practitioner)
    {
        $request->validate([
            'registration_number' => 'required|max:50|unique:practitioners,registration_number,' . $practitioner->id,
            'full_name' => 'required|max:255',
            'status_id' => 'required|exists:statuses,id',
            'speciality_id' => 'nullable|exists:specialities,id',
            'sub_speciality_id' => 'nullable|exists:sub_specialities,id',
            'address' => 'nullable|string',
            'profile_link' => 'nullable|url',
        ]);

        $practitioner->update($request->all());

        return redirect()->route('practitioners.index')
            ->with('success', 'Practitioner updated successfully.');
    }

    public function destroy(Practitioner $practitioner)
    {
        $practitioner->delete();

        return redirect()->route('practitioners.index')
            ->with('success', 'Practitioner deleted successfully.');
    }
}
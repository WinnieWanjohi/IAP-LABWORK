<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Models\Status;
use App\Models\Speciality;
use App\Models\SubSpeciality;
use Illuminate\Http\Request;

class PractitionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $practitioners = Practitioner::with(['status', 'speciality', 'subSpeciality'])
            ->latest()
            ->paginate(20);
        
        return view('practitioners.index', compact('practitioners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::where('is_active', true)->get();
        $specialities = Speciality::all();
        $subSpecialities = SubSpeciality::all();
        
        return view('practitioners.create', compact('statuses', 'specialities', 'subSpecialities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|unique:practitioners',
            'fullname' => 'required|string|max:255',
            'status_id' => 'nullable|exists:statuses,id',
            'speciality_id' => 'nullable|exists:specialities,id',
            'sub_speciality_id' => 'nullable|exists:sub_specialities,id',
            'address' => 'nullable|string',
            'registration_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
        ]);

        Practitioner::create($validated);

        return redirect()->route('practitioners.index')
            ->with('success', 'Practitioner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Practitioner $practitioner)
    {
        $practitioner->load(['status', 'speciality', 'subSpeciality', 'contacts', 'qualifications.degree', 'qualifications.institution', 'licenses']);
        
        return view('practitioners.show', compact('practitioner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Practitioner $practitioner)
    {
        $statuses = Status::where('is_active', true)->get();
        $specialities = Speciality::all();
        $subSpecialities = SubSpeciality::all();
        
        return view('practitioners.edit', compact('practitioner', 'statuses', 'specialities', 'subSpecialities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Practitioner $practitioner)
    {
        $validated = $request->validate([
            'registration_number' => 'required|unique:practitioners,registration_number,' . $practitioner->id,
            'fullname' => 'required|string|max:255',
            'status_id' => 'nullable|exists:statuses,id',
            'speciality_id' => 'nullable|exists:specialities,id',
            'sub_speciality_id' => 'nullable|exists:sub_specialities,id',
            'address' => 'nullable|string',
            'registration_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $practitioner->update($validated);

        return redirect()->route('practitioners.index')
            ->with('success', 'Practitioner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Practitioner $practitioner)
    {
        $practitioner->delete();

        return redirect()->route('practitioners.index')
            ->with('success', 'Practitioner deleted successfully.');
    }
}

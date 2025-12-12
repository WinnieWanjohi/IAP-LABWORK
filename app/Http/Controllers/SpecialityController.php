<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::withCount('practitioners')->latest()->get();
        return view('specialities.index', compact('specialities'));
    }

    public function create()
    {
        return view('specialities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:specialities',
            'code' => 'nullable|unique:specialities',
            'description' => 'nullable|string',
        ]);

        Speciality::create($validated);

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality created successfully.');
    }

    public function show(Speciality $speciality)
    {
        $speciality->load(['subSpecialities', 'practitioners']);
        return view('specialities.show', compact('speciality'));
    }

    public function edit(Speciality $speciality)
    {
        return view('specialities.edit', compact('speciality'));
    }

    public function update(Request $request, Speciality $speciality)
    {
        $validated = $request->validate([
            'name' => 'required|unique:specialities,name,' . $speciality->id,
            'code' => 'nullable|unique:specialities,code,' . $speciality->id,
            'description' => 'nullable|string',
        ]);

        $speciality->update($validated);

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality updated successfully.');
    }

    public function destroy(Speciality $speciality)
    {
        if ($speciality->practitioners()->count() > 0) {
            return redirect()->route('specialities.index')
                ->with('error', 'Cannot delete speciality with associated practitioners.');
        }

        $speciality->delete();

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality deleted successfully.');
    }
}

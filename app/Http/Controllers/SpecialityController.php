<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::withCount('practitioners')->latest()->paginate(10);
        return view('specialities.index', compact('specialities'));
    }

    public function create()
    {
        return view('specialities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specialities|max:255',
            'description' => 'nullable|string',
        ]);

        Speciality::create($request->all());

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality created successfully.');
    }

    public function show(Speciality $speciality)
    {
        $speciality->load('practitioners', 'subSpecialities');
        return view('specialities.show', compact('speciality'));
    }

    public function edit(Speciality $speciality)
    {
        return view('specialities.edit', compact('speciality'));
    }

    public function update(Request $request, Speciality $speciality)
    {
        $request->validate([
            'name' => 'required|max:255|unique:specialities,name,' . $speciality->id,
            'description' => 'nullable|string',
        ]);

        $speciality->update($request->all());

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality updated successfully.');
    }

    public function destroy(Speciality $speciality)
    {
        $speciality->delete();

        return redirect()->route('specialities.index')
            ->with('success', 'Speciality deleted successfully.');
    }
}
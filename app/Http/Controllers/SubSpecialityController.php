<?php

namespace App\Http\Controllers;

use App\Models\SubSpeciality;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SubSpecialityController extends Controller
{
    public function index()
    {
        $subSpecialities = SubSpeciality::with('speciality')->latest()->paginate(10);
        return view('subspecialities.index', compact('subSpecialities'));
    }

    public function create()
    {
        $specialities = Speciality::all();
        return view('subspecialities.create', compact('specialities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'speciality_id' => 'required|exists:specialities,id',
            'description' => 'nullable|string',
        ]);

        SubSpeciality::create($request->all());

        return redirect()->route('subspecialities.index')
            ->with('success', 'Sub Speciality created successfully.');
    }

    public function show(SubSpeciality $subspeciality)
    {
        $subspeciality->load('speciality', 'practitioners');
        return view('subspecialities.show', compact('subspeciality'));
    }

    public function edit(SubSpeciality $subspeciality)
    {
        $specialities = Speciality::all();
        return view('subspecialities.edit', compact('subspeciality', 'specialities'));
    }

    public function update(Request $request, SubSpeciality $subspeciality)
    {
        $request->validate([
            'name' => 'required|max:255',
            'speciality_id' => 'required|exists:specialities,id',
            'description' => 'nullable|string',
        ]);

        $subspeciality->update($request->all());

        return redirect()->route('subspecialities.index')
            ->with('success', 'Sub Speciality updated successfully.');
    }

    public function destroy(SubSpeciality $subspeciality)
    {
        $subspeciality->delete();

        return redirect()->route('subspecialities.index')
            ->with('success', 'Sub Speciality deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index()
    {
        $institutions = Institution::withCount('qualifications')->latest()->paginate(10);
        return view('institutions.index', compact('institutions'));
    }

    public function create()
    {
        return view('institutions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:institutions|max:255',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        Institution::create($request->all());

        return redirect()->route('institutions.index')
            ->with('success', 'Institution created successfully.');
    }

    public function show(Institution $institution)
    {
        $institution->load('qualifications.practitioner', 'qualifications.degree');
        return view('institutions.show', compact('institution'));
    }

    public function edit(Institution $institution)
    {
        return view('institutions.edit', compact('institution'));
    }

    public function update(Request $request, Institution $institution)
    {
        $request->validate([
            'name' => 'required|max:255|unique:institutions,name,' . $institution->id,
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        $institution->update($request->all());

        return redirect()->route('institutions.index')
            ->with('success', 'Institution updated successfully.');
    }

    public function destroy(Institution $institution)
    {
        $institution->delete();

        return redirect()->route('institutions.index')
            ->with('success', 'Institution deleted successfully.');
    }
}
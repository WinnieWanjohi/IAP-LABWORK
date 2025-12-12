<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function index()
    {
        $degrees = Degree::withCount('qualifications')->latest()->paginate(10);
        return view('degrees.index', compact('degrees'));
    }

    public function create()
    {
        return view('degrees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:degrees|max:255',
            'abbreviation' => 'nullable|string|max:50',
        ]);

        Degree::create($request->all());

        return redirect()->route('degrees.index')
            ->with('success', 'Degree created successfully.');
    }

    public function show(Degree $degree)
    {
        $degree->load('qualifications.practitioner', 'qualifications.institution');
        return view('degrees.show', compact('degree'));
    }

    public function edit(Degree $degree)
    {
        return view('degrees.edit', compact('degree'));
    }

    public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'name' => 'required|max:255|unique:degrees,name,' . $degree->id,
            'abbreviation' => 'nullable|string|max:50',
        ]);

        $degree->update($request->all());

        return redirect()->route('degrees.index')
            ->with('success', 'Degree updated successfully.');
    }

    public function destroy(Degree $degree)
    {
        $degree->delete();

        return redirect()->route('degrees.index')
            ->with('success', 'Degree deleted successfully.');
    }
}
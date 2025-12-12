<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\Practitioner;
use App\Models\Degree;
use App\Models\Institution;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::with(['practitioner', 'degree', 'institution'])
            ->latest()
            ->paginate(10);
        
        return view('qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        $practitioners = Practitioner::all();
        $degrees = Degree::all();
        $institutions = Institution::all();
        
        return view('qualifications.create', compact('practitioners', 'degrees', 'institutions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'degree_id' => 'required|exists:degrees,id',
            'institution_id' => 'required|exists:institutions,id',
            'year_awarded' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        Qualification::create($request->all());

        return redirect()->route('qualifications.index')
            ->with('success', 'Qualification created successfully.');
    }

    public function show(Qualification $qualification)
    {
        $qualification->load(['practitioner', 'degree', 'institution']);
        return view('qualifications.show', compact('qualification'));
    }

    public function edit(Qualification $qualification)
    {
        $practitioners = Practitioner::all();
        $degrees = Degree::all();
        $institutions = Institution::all();
        
        return view('qualifications.edit', compact('qualification', 'practitioners', 'degrees', 'institutions'));
    }

    public function update(Request $request, Qualification $qualification)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'degree_id' => 'required|exists:degrees,id',
            'institution_id' => 'required|exists:institutions,id',
            'year_awarded' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $qualification->update($request->all());

        return redirect()->route('qualifications.index')
            ->with('success', 'Qualification updated successfully.');
    }

    public function destroy(Qualification $qualification)
    {
        $qualification->delete();

        return redirect()->route('qualifications.index')
            ->with('success', 'Qualification deleted successfully.');
    }
}
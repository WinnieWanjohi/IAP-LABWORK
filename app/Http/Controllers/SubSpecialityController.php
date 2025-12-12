<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubSpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('subspecialities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subspecialities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('subspecialities.index')
            ->with('success', 'Sub-speciality created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('subspecialities.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('subspecialities.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('subspecialities.index')
            ->with('success', 'Sub-speciality updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('subspecialities.index')
            ->with('success', 'Sub-speciality deleted successfully.');
    }
}
CONTROLLER
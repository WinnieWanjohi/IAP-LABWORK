<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('institutions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('institutions.index')
            ->with('success', 'Institution created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('institutions.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('institutions.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('institutions.index')
            ->with('success', 'Institution updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('institutions.index')
            ->with('success', 'Institution deleted successfully.');
    }
}
CONTROLLER
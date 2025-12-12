<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Practitioner;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = License::with('practitioner')->latest()->paginate(10);
        return view('licenses.index', compact('licenses'));
    }

    public function create()
    {
        $practitioners = Practitioner::all();
        return view('licenses.create', compact('practitioners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'license_number' => 'required|unique:licenses|max:50',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
            'renewal_status' => 'required|in:active,expired,pending',
        ]);

        License::create($request->all());

        return redirect()->route('licenses.index')
            ->with('success', 'License created successfully.');
    }

    public function show(License $license)
    {
        $license->load('practitioner');
        return view('licenses.show', compact('license'));
    }

    public function edit(License $license)
    {
        $practitioners = Practitioner::all();
        return view('licenses.edit', compact('license', 'practitioners'));
    }

    public function update(Request $request, License $license)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'license_number' => 'required|max:50|unique:licenses,license_number,' . $license->id,
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
            'renewal_status' => 'required|in:active,expired,pending',
        ]);

        $license->update($request->all());

        return redirect()->route('licenses.index')
            ->with('success', 'License updated successfully.');
    }

    public function destroy(License $license)
    {
        $license->delete();

        return redirect()->route('licenses.index')
            ->with('success', 'License deleted successfully.');
    }
}
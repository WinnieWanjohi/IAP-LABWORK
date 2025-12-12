<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Practitioner;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('practitioner')->latest()->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        $practitioners = Practitioner::all();
        return view('contacts.create', compact('practitioners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'fax' => 'nullable|string|max:20',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        $contact->load('practitioner');
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $practitioners = Practitioner::all();
        return view('contacts.edit', compact('contact', 'practitioners'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'fax' => 'nullable|string|max:20',
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
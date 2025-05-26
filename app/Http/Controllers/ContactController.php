<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('content.admin.contact', compact('contacts'));
    }

    public function create()
    {
        return view('content.admin.create-contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_wa' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'instagram' => 'nullable|string|max:100',
            'facebook' => 'nullable|string|max:100',
        ]);

        Contact::create($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully');
    }

    public function edit(Contact $contact)
    {
        return view('content.admin.edit-contact', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'no_wa' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'instagram' => 'nullable|string|max:100',
            'facebook' => 'nullable|string|max:100',
        ]);

        $contact->update($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }
}

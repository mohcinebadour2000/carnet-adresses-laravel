<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class WebContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:30',
            'telephone' => 'required|string|max:10',
            'email' => 'required|string|email|max:50',
        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:30',
            'telephone' => 'required|string|max:10',
            'email' => 'required|string|email|max:50' . $id,
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect()->route('contacts.index');
    }
}

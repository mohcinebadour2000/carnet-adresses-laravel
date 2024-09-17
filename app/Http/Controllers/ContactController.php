<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Liste de tous les contacts
    public function index()
    {
        return Contact::all();
    }

    // Afficher un contact
    public function show($id)
    {
        return Contact::findOrFail($id);
    }

    // Creer un nouveau contact
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:30',
            'telephone' => 'required|string|max:10',
            'email' => 'required|email|max:50',
        ]);

        $contact = Contact::create($request->all());
        return response()->json($contact, 200);
    }

    // Mise a jour
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'nom' => 'sometimes|required|string|max:30',
            'telephone' => 'sometimes|required|string|max:10',
            'email' => 'sometimes|required|string|email|max:50' . $id,
        ]);

        $contact->update($request->all());
        return response()->json($contact, 200);
    }

    // Supprimer un contact
    public function destroy($id)
    {
        Contact::destroy($id);
        return response()->json("contact supprimmee avec success", 200);
    }
}

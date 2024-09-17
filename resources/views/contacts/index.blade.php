@extends('layouts.layout')

@section('title', 'Liste des Contacts')

@section('content')
    <h1 class="mb-4">Contacts</h1>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Ajouter un contact</a>
    <div class="list-group">
        @foreach ($contacts as $contact)
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $contact->nom }}</h5>
                    <p class="mb-1">{{ $contact->telephone }}</p>
                    <small>{{ $contact->email }}</small>
                </div>
                <div>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@extends('layouts.layout')

@section('title', 'Modifier un Contact')

@section('content')
    <h1 class="mb-4">Modifier un contact</h1>
    <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nom" value="{{ $contact->nom }}" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" class="form-control" name="telephone" id="telephone" value="{{ $contact->telephone }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $contact->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Retour</a>
    </form>
@endsection

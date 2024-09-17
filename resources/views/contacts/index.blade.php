@extends('layouts.layout')

@section('title', 'Liste des Contacts')

@section('content')
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#ajouterContact">
        Ajouter un contact
    </button>
    <div class="card">
        <h5 class="card-header">Carnet Adresses</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom complet</th>
                        <th>Telephone</th>
                        <th>E-mail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>
                                <i class="fas fa-user fa-lg me-3"></i>
                                <strong>{{ $contact->nom }}</strong>
                            </td>
                            <td>{{ $contact->telephone }}</td>
                            <td>
                                {{ $contact->email }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modifierContact{{ $contact->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#confirmerSuppressionModal{{ $contact->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal ajouter un contact --}}

    <div class="modal fade" id="ajouterContact" tabindex="-1" aria-labelledby="ajouterContactLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterContactLabel">Ajouter un Contact
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" name="nom" id="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone :</label>
                            <input type="text" class="form-control" name="telephone" id="telephone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Retour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Modifier un contact --}}
    @foreach ($contacts as $contact)
        <div class="modal fade" id="modifierContact{{ $contact->id }}" tabindex="-1"
            aria-labelledby="modifierContactLabel{{ $contact->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifierContactLabel{{ $contact->id }}">Modifier Contact
                            {{ $contact->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" class="form-control" name="nom" id="nom"
                                    value="{{ $contact->nom }}" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone :</label>
                                <input type="text" class="form-control" name="telephone" id="telephone"
                                    value="{{ $contact->telephone }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ $contact->email }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

  {{-- Modal Supprimer un contact --}}
    @foreach ($contacts as $contact)
        <div class="modal fade" id="confirmerSuppressionModal{{ $contact->id }}" tabindex="-1" role="dialog"
            aria-labelledby="confirmerSuppressionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmerSuppressionModalLabel">Confirmation de Suppression</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce contact ?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

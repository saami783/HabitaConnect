{{-- Assurez-vous que le layout 'welcome' contient les éléments Bootstrap nécessaires --}}
@extends('welcome')

<br><br><br>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">Hello</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">Titre : {{ $announce->title }}</h5>
                <p class="card-text">Description : {{ $announce->description }}</p>
                <p class="card-text">Adresse : {{ $announce->address }}</p>
                <p class="card-text">Prix par nuit : {{ number_format($announce->price_per_night, 2) }} €</p>
                <p class="card-text">Type de logement : {{ $announce->type }}</p>
                <p class="card-text">Utilisateur : {{ $announce->user->name }}</p>

                @if($announce->files->isEmpty())
                    <br>
                    <div class="alert alert-danger">
                        <p> Aucune images trouvées pour cette annonce. </p>
                    </div>
                @else
                    @foreach($announce->files as $file)
                        <img src="{{ asset($file->file_path) }}" alt="Announce Image">
                    @endforeach
                @endif

            </div>

            <div class="container">
                <h2>Création d'une Réservation</h2>

                <p>Prix par nuit : {{ $announce->price_per_night  }} </p>
                <form method="POST" action="{{ route('reservations.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="begin_at">Date de début</label>
                        <input type="date" class="form-control" id="begin_at" name="begin_at" required>
                    </div>

                    <div class="form-group">
                        <label for="end_at">Date de fin</label>
                        <input type="date" class="form-control" id="end_at" name="end_at" required>
                    </div>

                    <input type="hidden" name="announce_id" id="announce_id" value="{{ $announce->id }}" autocomplete="off">

                    <button type="submit" class="btn btn-primary">Réserver</button>
                </form>
            </div>

            @auth
                @if(auth()->user()->id == $announce->user_id)
                    <div class="card-footer text-muted">
                        <a href="{{ route('announces.edit', $announce) }}" class="btn btn-primary">Modifier</a>

                        {{-- Formulaire de suppression --}}
                        <form action="{{ route('announces.destroy', $announce) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                @endif
            @endauth

        </div>
    </div>

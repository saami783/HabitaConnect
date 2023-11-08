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

{{-- Assurez-vous que le layout 'welcome' contient les éléments Bootstrap nécessaires --}}
@extends('welcome')

<br><br>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 style="color: lightcoral"> <strong>Section informations de l'annonce</strong></h1>
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
                        <p class="alert alert-danger"> Aucune images trouvées pour cette annonce. </p>
                    </div>
                @else
                    @foreach($announce->files as $file)
                        <img src="{{ asset($file->file_path) }}" alt="Announce Image">
                    @endforeach
                @endif

                <br>
                <h1 style="color: lightcoral"> <strong>Section équipements</strong></h1>
                @foreach($equipments as $equipment)
                    <p> {{ $equipment->name }}</p>
                @endforeach
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
                @else
                    <br>
                    <div class="container">
                        <h1 style="color: lightcoral"> <strong>Section Réservation</strong></h1>

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

                            @if($announce->is_disponible)
                            <button type="submit" class="btn btn-primary">Réserver</button>
                            @else
                                <p style="color: red;"> Impossible de passer une réservation pour cette annonce car elle est insponible.</p>
                            @endif
                        </form>
                    </div>
                    <h1 style="color: lightcoral"> <strong>Section Avis</strong></h1>
{{--                    @if()--}}
                        <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                    <label for="content">Mon avis</label>
                                <input type="text" class="form-control" id="content" name="content" required>
                            </div>
                            <div class="form-group">
                                <label for="note">Note sur 5</label>
                                <input type="number" class="form-control" id="note" name="note" required>
                            </div>

                            <input type="hidden" name="announce_id" id="announce_id" value="{{ $announce->id }}" autocomplete="off">
                            <input type="hidden" name="announce_id" id="announce_id" value="{{ $announce->user_id }}" autocomplete="off">

                            <button type="submit">Envoyer mon avis </button>
                        </form>
{{--                    @endif--}}
                @endif
            @endauth
            @foreach($reviews as $review)
               <p style="color: lightsalmon"> Utilisateur : {{ $review->user->email }}</p>
                <p> Commentaire : {{ $review->content }}</p>
                <p style="color: lightseagreen"> Note : {{ $review->note }}</p>
            @endforeach
        </div>
    </div>

{{-- Assurez-vous que le layout 'welcome' contient les éléments Bootstrap nécessaires --}}
@extends('welcome')
<link href="{{ asset('css/detailOffre_CSS.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css"/>

@section('content')
    <div class="div-main">
        <div class="div-titre">
            {{--     titre     --}}
            <h5 class="card-title">{{ $announce->title }}</h5>
        </div>
        <div class="div-image">
            @if($announce->files->isEmpty())
                <div class="image-not-found">
                    <p> Aucune images trouvées pour cette annonce. </p>
                </div>
            @else
                @foreach($announce->files as $file)
                    <img src="{{ asset($file->file_path) }}" alt="Announce Image">
                @endforeach
            @endif
        </div>

                {{--        Upper main section        --}}

        <section class="section-upper-main">
            <section class="section-left">

                <div class="div-prix">
                    <div class="div-all-logo">
                        <img src="{{asset('images/logo_prix.svg')}}" alt="logo adresse" class="all-logos_upper-main">
                        <p>Prix par nuit:</p>
                    </div>
                    <p class="card-text"><strong>{{ $announce->price_per_night  }} </strong></p>
                </div>

                <div class="div-adresse">
                    <div class="div-all-logo">
                        <img src="{{asset('images/logo_adresse.svg')}}" alt="logo adresse" class="all-logos_upper-main">
                        <p>Adresse:</p>
                    </div>
                    <p class="card-text"><strong>{{ $announce->address }}</strong></p>
                </div>

                <div class="div-description">
                    <div class="div-all-logo">
                        <img src="{{asset('images/logo_description.svg')}}" alt="logo adresse" class="all-logos_upper-main">
                        <p>Description:</p>
                    </div>
                    <p class="card-text"><strong>{{ $announce->description }}</strong></p>
                </div>

                <div class="div-type-logement">
                    <div class="div-all-logo">
                        <img src="{{asset('images/logo_type.svg')}}" alt="logo adresse" class="all-logos_upper-main">
                        <p>Type de logement:</p>
                    </div>
                    <p class="card-text"><strong>{{ $announce->type }}</strong></p>
                </div>

                <div class="div-utilisateur">
                    <div class="div-all-logo">
                        <img src="{{asset('images/logo_user.svg')}}" alt="logo adresse" class="all-logos_upper-main">
                        <p>Utilisateur:</p>
                    </div>
                    <p class="card-text"><strong>{{ $announce->user->name }}</strong></p>
                </div>

                <div class="div-equipement">
                    <div class="div-all-logo">
                        <img src="{{asset('images/logo_equipement.svg')}}" alt="logo adresse" class="all-logos_upper-main">
                        <p>équipements:</p>
                    </div>
                    @foreach($equipments as $equipment)
                        <p class="card-text"><strong>{{ $equipment->name }}</strong></p>
                    @endforeach

                </div>
            </section>

            <section class="section-right">
                @auth
                    @if(auth()->user()->id == $announce->user_id)
                        <div class="div-deja-reserve">
                            <a href="{{ route('announces.edit', $announce) }}" class="btn btn-primary">Modifier</a>

                            {{-- Formulaire de suppression --}}
                            <form action="{{ route('announces.destroy', $announce) }}" method="POST"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    @else
                        <div class="div-à-reserver">
                            <h3><strong>Réservation</strong></h3>
                            <hr style="color: #4a5568" />

                            <form method="POST" action="{{ route('reservations.store') }}">
                                @csrf
                                <div class="div-date-debut">
                                    <label for="begin_at">Date de début</label>
                                    <input type="date" class="form-control" id="begin_at" name="begin_at" required>
                                </div>

                                <div class="div-date-fin">
                                    <label for="end_at">Date de fin</label>
                                    <input type="date" class="form-control" id="end_at" name="end_at" required>
                                </div>

                                <input type="hidden" name="announce_id" id="announce_id" value="{{ $announce->id }}"
                                       autocomplete="off">

                                <p class="prix-par-nuit">Prix par nuit : {{ number_format($announce->price_per_night, 2) }} €</p>

                                @if($announce->is_disponible)
                                    <div class="div-btn-reserver">
                                        <button type="submit" class="btn btn-reserver">Réserver</button>
                                    </div>
                                @else
                                    <div class="div-imossible-de-reserver">
                                        <p class="p-impossible_de_reserver"><b>Impossible de passer une réservation pour cette annonce car elle est insponible.</b> </p>
                                    </div>
                                @endif
                            </form>
                        </div>
                    @endif
                @endauth
            </section>
        </section>

        <hr style="margin-top: 40px"/>

        <h1 style="color: lightcoral"> <strong>Section Avis</strong></h1>
        @if($can_post_review)
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
                <input type="hidden" name="user_id" id="user_id" value="{{ $announce->user_id }}" autocomplete="off">

                <button type="submit">Envoyer mon avis </button>
            </form>
        @endif

        @foreach($reviews as $review)
            <p style="color: lightsalmon"> Utilisateur : {{ $review->user->email }}</p>
            <p> Commentaire : {{ $review->content }}</p>
            <p style="color: lightseagreen"> Note : {{ $review->note }}</p>
        @endforeach

    </div>
@endsection

@extends('welcome')
<link href="{{ asset('css/detailOffre_CSS.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css"/>

@section('content')
    <div class="div-main">
        <div class="div-titre">
            <h5 class="card-title">{{ $announce->title }}</h5>
        </div>
        <div class="div-image">
            @if($announce->files->isEmpty())
                <img src="{{asset('images/images/no_image_disponible.svg')}}" alt="sans image" title="Aucune image disponible pour cette offre" class="offre_image">
            @else
                @foreach($announce->files as $file)

                    <div class="div_offre_image">
                        <img src="{{ asset($file->file_path) }}" alt="Announce Image" style="width:100px; height:auto;" class="offre_image">
                    </div>
                @endforeach
            @endif
        </div>

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
                    @if(auth()->user()->id != $announce->user_id)
                        @include('partials.reservation_form', ['announce' => $announce])
                    @else
                            <div class="div-deja-reserve">
                                <a href="{{ route('announces.edit', $announce) }}" class="btn btn-primary">Modifier</a>
                                <form action="{{ route('announces.destroy', $announce) }}" method="POST"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                    @endif
                @else
                    @include('partials.reservation_form', ['announce' => $announce])
                @endauth
            </section>

            <hr style="margin-top: 40px"/>

        <h1 style="color: lightcoral"> <strong>Section Avis</strong></h1>
        @if($can_post_review)
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="review_content">Mon avis</label>
                    <input type="text" class="form-control" id="review_content" name="review_content" required>
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

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @foreach($reviews as $review)
            <p style="color: lightsalmon"> Utilisateur : {{ $review->user->email }}</p>
            <p> Commentaire : {{ $review->content }}</p>
            <p style="color: lightseagreen"> Note : {{ $review->note }}</p>
        @endforeach

    </div>
@endsection

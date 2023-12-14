@extends('welcome')
<link href="{{ asset('css/reservation_style/reservationDetail_CSS.css')}}" rel="stylesheet" type="text/css"/>

@section('content')
    <section id="reservation_item">
        <p id="reservation_id"> Id : {{ $reservation->id }}</p>
        <p id="reservation_date-debut"> Begin at : {{ $reservation->begin_at }} </p>
        <p id="reservation_date-fin"> End at : {{ $reservation->end_at }} </p>
        <p id="reservation_user-id"> User id : {{ $reservation->user_id }} </p>
        <p id="reservation_annonce-id"> Announce id : {{ $reservation->announce_id }} </p>
        <p id="reservation_prix-total"> Price : {{ $reservation->price }} </p>
        <p id="reservation_jours"> Total days : {{ $reservation->total_days }} </p>
        <p id="reservation_status"> Status : {{ $reservation->status }} </p>

        <div class="div_buttons">
            @if($reservation->status === "Réservation non finalisée")
                <form action="/session" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type='hidden' name="total" value="{{ $reservation->price }}">
                    <input type='hidden' name="productname" value="{{ $reservation->announce_id }}">
                    <input type='hidden' name="reservation" value="{{ $reservation->id }}">
                    <button class="btn btn-success" type="submit" id="checkout-live-button">Payer</button>
                </form>

                <div class="card-footer text-muted">
                    {{-- Formulaire de suppression --}}
                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette reservation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            @else
                <p><a href="{{ route('generatePdf', $reservation) }}"> Ma facture </a></p>
            @endif
        </div>
    </section>
@endsection

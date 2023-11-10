@extends('welcome')

@section('content')
    <p> Id : {{ $reservation->id }}</p>
    <p> Begin at :  {{ $reservation->begin_at }} </p>
    <p> End at : {{ $reservation->end_at }} </p>
    <p> User id : {{ $reservation->user_id }} </p>
    <p> Announce id : {{ $reservation->announce_id }} </p>
    <p> Price : {{ $reservation->price }} </p>
    <p> Total days : {{ $reservation->total_days }} </p>
    <p> Status : {{ $reservation->status }} </p>

    @if($reservation->status === "Réservation non finalisée")
        <p style="color: red;"> Bouton de paiement </p>
    @endif
@endsection

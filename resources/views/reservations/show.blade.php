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
        <form action="/session" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type='hidden' name="total" value="{{ $reservation->price }}">
            <input type='hidden' name="productname" value="{{ $reservation->announce_id }}">
            <input type='hidden' name="reservation" value="{{ $reservation->id }}">
            <button class="btn btn-success" type="submit" id="checkout-live-button">Payer</button>
        </form>
    @endif
@endsection

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

        <div class="card-footer text-muted">
            {{-- Formulaire de suppression --}}
            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette reservation ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    @else
        <p> <a href="{{ route('generatePdf', $reservation) }}"> Ma facture </a> </p>
    @endif
@endsection

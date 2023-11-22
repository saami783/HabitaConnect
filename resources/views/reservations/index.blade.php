@extends('welcome')

@section('content')
    @foreach($reservations as $reservation)
        <p>
            <a href="{{ route('reservations.show', $reservation) }}"> Reservation numéro {{ $reservation->id }}</a>
        </p>
    @endforeach
@endsection

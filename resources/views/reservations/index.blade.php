@extends('welcome')
 <link rel="stylesheet" href="{{asset('css/reservation_style/reservation_CSS.css')}}">
@section('content')

    <div class="h1">
        <h1><strong>Mes reservations</strong></h1>
    </div>
    <div class="main">
    @foreach($reservations as $reservation)
        <p>
            <a href="{{ route('reservations.show', $reservation) }}"> Reservation numéro {{ $reservation->id }}</a>
        </p>
    @endforeach
    </div>
@endsection

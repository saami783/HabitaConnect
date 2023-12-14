@extends('welcome')
<link rel="stylesheet" href="{{asset('css/reservation_style/reservation_CSS.css')}}">


@section('content')
    <div class="h1">
        <h1><strong>Mes reservations</strong></h1>
    </div>
    <div class="main">
        @foreach($reservations as $reservation)
            <div class="reservation_detail">
                <p>Reservation numéro <br />{{ $reservation->id }}</p>
                <p>prix total: <br />{{ $reservation->price }}</p>
                <p id="reservation_jours"> Total days : <br />{{ $reservation->total_days }} </p>
                <p id="reservation_status"> Status : <br />{{ $reservation->status }} </p>
                <a href="{{ route('reservations.show', $reservation) }}" class="voir_detail">Voir plus de détail</a>
            </div>

        @endforeach
    </div>
@endsection

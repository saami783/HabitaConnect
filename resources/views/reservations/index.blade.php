@extends('welcome')

@section('content')
    @foreach($reservations as $reservation)
        <p> {{ $reservation->id }}</p>
    @endforeach
@endsection

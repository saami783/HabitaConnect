@extends('layouts.admin')

    <link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Réservations') }}
@endsection

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Utilisateur</th>
            <th scope="col">Annonce</th>
            <th scope="col">Status</th>
            <th scope="col">Prix</th>
            <th scope="col">Nombre de jours</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <th scope="row">{{ $reservation->id }}</th>
                <td><a href="{{ route("admin.users.show", $reservation->user) }}" style="color: #3d95d1"> {{ $reservation->user->email }} </a></td>
                <td><a href="{{ route("admin.announces.show", $reservation->announce) }}" style="color: #3d95d1"> {{ $reservation->announce->title }} </a></td>
                <td>{{ $reservation->status }}</td>
                <td>{{ $reservation->price }} €</td>
                <td>{{ $reservation->total_days }} j</td>
                <td class="actions actions-as-dropdown">
                    <div class="dropdown dropdown-actions">
                        <a class="dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="21" width="21" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item action-detail"  href="{{ route('admin.reservations.show', $reservation) }}" data-action-name="detail"><span class="action-label">Consulter</span></a>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $reservations->links() }}
@endsection

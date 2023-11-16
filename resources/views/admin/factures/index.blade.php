@extends('layouts.admin')

    <link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Factures') }}
@endsection

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Utilisateur</th>
            <th scope="col">Annonce</th>
            <th scope="col">Réservation</th>
            <th scope="col">Montant</th>
        </tr>
        </thead>
        <tbody>
        @foreach($factures as $facture)
            <tr>
                <th scope="row">{{ $facture->id }}</th>
                <td>  <a href="{{ route("admin.users.show", $facture->user_id) }}" style="color: #3d95d1"> {{ $facture->user->email }} </a> </td>
                <td>  <a href="{{ route("admin.announces.show", $facture->announce_id) }}" style="color: #3d95d1"> {{ $facture->announce->title }} </a> </td>
                <td> <a href="{{ route("admin.reservations.show", $facture->reservation_id) }}" style="color: #3d95d1"> {{ $facture->reservation->id }} </a> </td>
                <td> {{ $facture->amount }} €</td>
                <td class="actions actions-as-dropdown">
                    <div class="dropdown dropdown-actions">
                        <a class="dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="21" width="21" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item action-detail"  href="{{ route('admin.factures.show', $facture) }}" data-action-name="detail"><span class="action-label">Consulter</span></a>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $factures->links() }}
@endsection

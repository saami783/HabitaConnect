@extends('layouts.admin')

@section('title')
    {{ __('Factures') }}
@endsection

@section('content')
    <style>
        .content-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            margin: 0;
            padding: 0;
            font-size: 1.5em;
        }

        .page-actions {
            display: flex;
        }

        .btn {
            margin-left: 10px;
        }
    </style>

    <div class="user-details-container">
        <div class="user-details-panel">

            <section class="content-header">
                <div class="content-header-flex">
                    <h1 class="title">
                        <strong> Facture nº {{ $facture->id }} </strong>
                    </h1>
                    <div class="page-actions">
                        <a class="action-index btn btn-secondary" href="{{ route('admin.users') }}" data-action-name="index"><span class="action-label">Retour à la liste</span></a>
                    </div>
                </div>
            </section>

            <hr>
            <div class="user-details">
                <div class="detail">
                    <span class="label">ID :</span>
                    <span class="value"> {{ $facture->id }} </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Utilisateur  :</span>
                    <span class="value"> <a href="{{ route("admin.users.show", $facture->user_id) }}" style="color: #3d95d1"> {{ $facture->user->email }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Annonce :</span>
                    <span class="value"> <a href="{{ route("admin.announces.show", $facture->announce_id) }}" style="color: #3d95d1"> {{ $facture->announce->title }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Réservation :</span>
                    <span class="value"> <a href="{{ route("admin.reservations.show", $facture->reservation_id) }}" style="color: #3d95d1"> {{ $facture->reservation->id }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Montant total :</span>
                    <span class="value"> {{ $facture->amount }} </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Crée le :</span>
                    <span class="value"> {{ $facture->created_at }} </span>
                </div>
                <hr>
            </div>

        </div>
    </div>
@endsection

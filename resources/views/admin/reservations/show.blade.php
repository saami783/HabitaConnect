@extends('layouts.admin')

@section('title')
    {{ __('Réservations') }}
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
                        <strong> {{ $reservation->id }} </strong>
                    </h1>
                    <div class="page-actions">
                        <a class="action-index btn btn-secondary" href="{{ route('admin.reservations') }}" data-action-name="index"><span class="action-label">Retour à la liste</span></a>
                    </div>
                </div>
            </section>

            <hr>
            <div class="user-details">
                <div class="detail">
                    <span class="label">ID :</span>
                    <span class="value"> {{ $reservation->id }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Date de début de la réservation :</span>
                    <span class="value"> {{ date('d-M-Y', strtotime($reservation->being_at)) }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Date de fin de la réservation :</span>
                    <span class="value"> {{ date('d-M-Y', strtotime($reservation->end_at)) }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Nombre de jours total :</span>
                    <span class="value">{{ $reservation->total_days }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Utilisateur :</span>
                    <span class="value"><a href="{{ route("admin.users.show", $reservation->user) }}" style="color: #3d95d1"> {{ $reservation->user->email }} </a></span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Annonce :</span>
                    <span class="value"> <a href="{{ route("admin.announces.show", $reservation->announce) }}" style="color: #3d95d1"> {{ $reservation->announce->title }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Statut :</span>
                    <span class="value">{{ $reservation->status }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Prix :</span>
                    <span class="value">{{ $reservation->price }} € </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Crée le :</span>
                    <span class="value">{{ date('d-M-Y', strtotime($reservation->created_at)) }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Modifié le :</span>
                    <span class="value">{{ date('d-M-Y', strtotime($reservation->updated_at)) }}</span>
                </div>
                <hr>
            </div>

        </div>
    </div>
@endsection

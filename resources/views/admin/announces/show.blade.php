@extends('layouts.admin')

@section('title')
    {{ __('Annonces') }}
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
                        <strong> {{ $announce->title }} </strong>
                    </h1>
                    <div class="page-actions">
                        <a class="action-index btn btn-secondary" href="{{ route('admin.announces') }}" data-action-name="index"><span class="action-label">Retour à la liste</span></a>
                        <a class="action-edit btn btn-primary" href="{{ route('admin.announces.edit', $announce) }}" data-action-name="edit"><span class="action-label">Modifier</span></a>
                        <form id="delete-form-{{ $announce->id }}" action="{{ route('admin.announces.destroy', $announce) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $announce->id }}').submit();"><span class="action-label btn btn-outline-danger">Supprimer</span></a>

                    </div>
                </div>
            </section>

            <hr>
            <div class="user-details">
                <div class="detail">
                    <span class="label">ID :</span>
                    <span class="value"> {{ $announce->id }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Titre :</span>
                    <span class="value"> {{ $announce->title }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Description :</span>
                    <span class="value"> {{ $announce->description }} </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Adresse  :</span>
                    <span class="value">{{ $announce->address }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Prix  :</span>
                    <span class="value">{{ $announce->price_per_night }} € </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Type  :</span>
                    <span class="value">{{ $announce->type }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Disponible  :</span>
                    <span class="value">{{ $announce->is_diponible }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Nombre personnes autorisées :</span>
                    <span class="value">{{ $announce->max_persons }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Propriétaire  :</span>
                    <span class="value"><a href="{{ route("admin.users.show", $announce->user_id) }}" style="color: #3d95d1"> {{ $announce->user->email }} </a></span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Crée le  :</span>
                    <span class="value">{{ $announce->created_at }}</span>
                </div>
                <hr>
            </div>
            <div class="detail">
                <span class="label">Modifié le   :</span>
                <span class="value">{{ $announce->updated_at }}</span>
            </div>
            <hr>

        </div>
    </div>
@endsection

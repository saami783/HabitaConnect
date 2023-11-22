@extends('layouts.admin')

@section('title')
    {{ __('Messages') }}
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
                        <strong> Message de  {{ $message->expediteur->email }} </strong>
                    </h1>
                    <div class="page-actions">
                        <a class="action-index btn btn-secondary" href="{{ route('admin.messages') }}" data-action-name="index"><span class="action-label">Retour à la liste</span></a>
                        <form id="delete-form-{{ $message->id }}" action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $message->id }}').submit();"><span class="action-label btn btn-outline-danger">Supprimer</span></a>

                    </div>
                </div>
            </section>

            <hr>
            <div class="user-details">
                <div class="detail">
                    <span class="label">ID :</span>
                    <span class="value"> {{ $message->id }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Auteur :</span>
                    <span class="value"> <a href="{{ route("admin.users.show", $message->author) }}" style="color: #3d95d1"> {{ $message->expediteur->email }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Destinataire :</span>
                    <span class="value"> <a href="{{ route("admin.users.show", $message->destinataire_id) }}" style="color: #3d95d1"> {{ $message->destinataire->email }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Contenu :</span>
                    <span class="value">{{ $message->contenu}}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Envoyé le :</span>
                    <span class="value">{{ $message->created_at }}</span>
                </div>
                <hr>
            </div>

        </div>
    </div>
@endsection

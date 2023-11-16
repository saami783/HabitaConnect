@extends('layouts.admin')

@section('title')
    {{ __('Avis') }}
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
                        <strong> Avis publié par {{ $review->user->email }} </strong>
                    </h1>
                    <div class="page-actions">
                        <a class="action-index btn btn-secondary" href="{{ route('admin.reviews') }}" data-action-name="index"><span class="action-label">Retour à la liste</span></a>
                        <form id="delete-form-{{ $review->id }}" action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $review->id }}').submit();"><span class="action-label btn btn-outline-danger">Supprimer</span></a>

                    </div>
                </div>
            </section>

            <hr>
            <div class="user-details">
                <div class="detail">
                    <span class="label">ID :</span>
                    <span class="value"> {{ $review->id }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Utilisateur :</span>
                    <span class="value"> <a href="{{ route("admin.users.show", $review->user) }}" style="color: #3d95d1"> {{ $review->user->email }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Annonce :</span>
                    <span class="value"> <a href="{{ route("admin.announces.show", $review->announce_id) }}" style="color: #3d95d1"> {{ $review->announce_id }} </a> </span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Note :</span>
                    <span class="value">{{ $review->note }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Contenu :</span>
                    <span class="value">{{ $review->content }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Crée le :</span>
                    <span class="value">{{ $review->created_at }}</span>
                </div>
                <hr>
            </div>

        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title')
    {{ __('Utilisateurs') }}
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
                        <strong> {{ $user->email }} </strong>
                    </h1>
                    <div class="page-actions">
                        <a class="action-index btn btn-secondary" href="{{ route('admin.users') }}" data-action-name="index"><span class="action-label">Retour à la liste</span></a>
                        <a class="action-edit btn btn-primary" href="{{ route('admin.users.edit', $user) }}" data-action-name="edit"><span class="action-label">Modifier</span></a>
                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();"><span class="action-label btn btn-outline-danger">Supprimer</span></a>

                    </div>
                </div>
            </section>

            <hr>
            <div class="user-details">
                <div class="detail">
                    <span class="label">ID :</span>
                    <span class="value"> {{ $user->id }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Nom :</span>
                    <span class="value"> {{ $user->name }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Email :</span>
                    <span class="value">{{ $user->email }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Téléphone :</span>
                    <span class="value">{{ $user->number_phone }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Rôles :</span>
                    <ul class="value">
                        @foreach($user->role as $role)
                            <li>- {{ $role }}</li>
                        @endforeach
                    </ul>
                </div>
                <hr>
            </div>

        </div>
    </div>
@endsection

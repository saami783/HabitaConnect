@extends('layouts.admin')

@section('title')
    {{ __('Équipements') }}
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
                        <strong> {{ $equipment->name }} </strong>
                    </h1>
                    <div class="page-actions">
                        <a class="action-index btn btn-secondary" href="{{ route('admin.equipments') }}" data-action-name="index"><span class="action-label">Retour à la liste</span></a>
                        <a class="action-edit btn btn-primary" href="{{ route('admin.equipments.edit', $equipment) }}" data-action-name="edit"><span class="action-label">Modifier</span></a>
                        <form id="delete-form-{{ $equipment->id }}" action="{{ route('admin.equipments.destroy', $equipment) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $equipment->id }}').submit();"><span class="action-label btn btn-outline-danger">Supprimer</span></a>

                    </div>
                </div>
            </section>

            <hr>
            <div class="user-details">
                <div class="detail">
                    <span class="label">ID :</span>
                    <span class="value"> {{ $equipment->id }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Nom :</span>
                    <span class="value"> {{ $equipment->name }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Crée le :</span>
                    <span class="value">{{ $equipment->created_at }}</span>
                </div>
                <hr>
                <div class="detail">
                    <span class="label">Modifié le :</span>
                    <span class="value">{{ $equipment->updated_at }}</span>
                </div>
                <hr>
            </div>

        </div>
    </div>
@endsection

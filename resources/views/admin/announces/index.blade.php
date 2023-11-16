@extends('layouts.admin')

    <link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Annonces') }}
@endsection

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Type</th>
            <th scope="col">Prix</th>
            <th scope="col">Propriétaire</th>
        </tr>
        </thead>
        <tbody>
        @foreach($announces as $announce)
            <tr>
                <th scope="row">{{ $announce->id }}</th>
                <td>{{ $announce->title }}</td>
                <td>{{ $announce->type }}</td>
                <td>{{ $announce->price_per_night}}</td>
                <td> <a href="{{ route("admin.users.show", $announce->user_id) }}" style="color: #3d95d1"> {{ $announce->user->email }} </a></td>
                <td class="actions actions-as-dropdown">
                    <div class="dropdown dropdown-actions">
                        <a class="dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="21" width="21" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item action-detail"  href="{{ route('admin.announces.show', $announce) }}" data-action-name="detail"><span class="action-label">Consulter</span></a>

                            <form id="delete-form-{{ $announce->id }}" action="{{ route('admin.announces.destroy', $announce) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $announce->id }}').submit();"><span class="action-label">Supprimer</span></a>

                            <a class="dropdown-item action-edit" href="{{ route('admin.announces.edit', $announce) }}" data-action-name="edit"><span class="action-label">Modifier</span></a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $announces->links() }}
@endsection

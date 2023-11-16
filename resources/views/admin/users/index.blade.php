@extends('layouts.admin')

    <link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Utilisateurs') }}
@endsection

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Numéro de téléphone</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->number_phone}}</td>
                <td class="actions actions-as-dropdown">
                    <div class="dropdown dropdown-actions">
                        <a class="dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="21" width="21" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item action-detail"  href="{{ route('admin.users.show', $user) }}" data-action-name="detail"><span class="action-label">Consulter</span></a>

                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();"><span class="action-label">Supprimer</span></a>

                            <a class="dropdown-item action-edit" href="{{ route('admin.users.edit', $user) }}" data-action-name="edit"><span class="action-label">Modifier</span></a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection

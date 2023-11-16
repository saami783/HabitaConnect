@extends('layouts.admin')

    <link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Messages') }}
@endsection

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Auteur</th>
            <th scope="col">Destinataire</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <th scope="row">{{ $message->id }}</th>
                <td>  <a href="{{ route("admin.users.show", $message->author) }}" style="color: #3d95d1"> {{ $message->expediteur->email }} </a> </td>
                <td>  <a href="{{ route("admin.users.show", $message->destinataire_id) }}" style="color: #3d95d1"> {{ $message->destinataire->email }} </a> </td>
                <td class="actions actions-as-dropdown">
                    <div class="dropdown dropdown-actions">
                        <a class="dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="21" width="21" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item action-detail"  href="{{ route('admin.messages.show', $message) }}" data-action-name="detail"><span class="action-label">Consulter</span></a>

                            <form id="delete-form-{{ $message->id }}" action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $message->id }}').submit();"><span class="action-label">Supprimer</span></a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
@endsection

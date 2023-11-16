@extends('layouts.admin')

    <link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Avis') }}
@endsection

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Utilisateur</th>
            <th scope="col">Annonce</th>
            <th scope="col">Note</th>
            <th scope="col">Publié le</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <th scope="row">{{ $review->id }}</th>
                <td>  <a href="{{ route("admin.users.show", $review->user) }}" style="color: #3d95d1"> {{ $review->user->email }} </a> </td>
                <td>  <a href="{{ route("admin.announces.show", $review->announce_id) }}" style="color: #3d95d1"> {{ $review->announce_id }} </a> </td>
                <td>{{ $review->note}}</td>
                <td>{{ $review->created_at}}</td>
                <td class="actions actions-as-dropdown">
                    <div class="dropdown dropdown-actions">
                        <a class="dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg" height="21" width="21" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="">
                            <a class="dropdown-item action-detail"  href="{{ route('admin.reviews.show', $review) }}" data-action-name="detail"><span class="action-label">Consulter</span></a>

                            <form id="delete-form-{{ $review->id }}" action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="dropdown-item action-delete" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $review->id }}').submit();"><span class="action-label">Supprimer</span></a>

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $reviews->links() }}
@endsection

@extends('layouts.admin')

<link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Utilisateurs') }}
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf {{-- Token CSRF --}}
        @method('PATCH') {{-- Méthode HTTP PATCH pour la mise à jour --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('address', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('address', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="number_phone">Numéro de téléphone</label>
            <input type="text" class="form-control" id="number_phone" name="number_phone" value="{{ old('address', $user->number_phone) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection

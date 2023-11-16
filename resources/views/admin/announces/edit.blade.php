@extends('layouts.admin')

<link href="{{ asset("/css/admin/index.css") }}" rel="stylesheet" />

@section('title')
    {{ __('Annonces') }}
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

    <form method="POST" action="{{ route('admin.announces.update', $announce) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $announce->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $announce->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $announce->address) }}" required>
        </div>

        <div class="form-group">
            <label for="price_per_night">Prix par Nuit</label>
            <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $announce->price_per_night) }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="house" {{ $announce->type == 'house' ? 'selected' : '' }}>Maison</option>
                <option value="apartment" {{ $announce->type == 'apartment' ? 'selected' : '' }}>Appartement</option>
                <option value="room" {{ $announce->type == 'room' ? 'selected' : '' }}>Chambre</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection

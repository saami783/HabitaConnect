{{-- resources/views/announces/edit.blade.php --}}

<header>
    @extends('welcome')
</header>

<br><br>
    <div class="container">

        {{-- Assurez-vous que l'action pointe vers la route 'annonces.update' et utilise la méthode PATCH --}}
        <form method="POST" action="{{ route('announces.update', $announce) }}">
            @csrf {{-- Token CSRF --}}
            @method('PATCH') {{-- Méthode HTTP PATCH pour la mise à jour --}}

            {{-- Champ pour le titre --}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $announce->title) }}" required>
            </div>

            {{-- Champ pour la description --}}
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $announce->description) }}</textarea>
            </div>

            {{-- Champ pour l'adresse --}}
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $announce->address) }}" required>
            </div>

            {{-- Champ pour le prix par nuit --}}
            <div class="form-group">
                <label for="price_per_night">Price per Night</label>
                <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $announce->price_per_night) }}" required>
            </div>

            {{-- Sélection pour le type --}}
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="house" {{ $announce->type == 'house' ? 'selected' : '' }}>House</option>
                    <option value="apartment" {{ $announce->type == 'apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="room" {{ $announce->type == 'room' ? 'selected' : '' }}>Room</option>
                </select>
            </div>

            {{-- Bouton de soumission --}}
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

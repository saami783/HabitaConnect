{{-- resources/views/announces/create.blade.php --}}

<header>
    @extends('welcome')
</header>

<div class="container">
    <br><br>
    <form method="POST" action="{{ route('announces.store') }}" enctype="multipart/form-data">
        @csrf {{-- CSRF protection field --}}

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="form-group">
            <label for="price_per_night">Price per Night</label>
            <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="house">House</option>
                <option value="apartment">Apartment</option>
                <option value="room">Room</option>
            </select>
        </div>

        <div class="form-group">
            <label for="equipments">Equipments</label>
            <select class="form-control" id="equipments" name="equipments[]" multiple>
                @foreach ($equipments as $equipment)
                    <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="container mt-5">
                <h3 class="text-center mb-5">Images</h3>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="form-group">
                <label for="file">Photos de l'annonce</label>
                <input type="file" class="form-control" id="file" name="files[]" multiple>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer mon annonce</button>
    </form>
</div>


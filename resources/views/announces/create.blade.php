{{-- resources/views/announces/create.blade.php --}}

<header>
    @extends('welcome')
</header>

<div class="container">
    <h1>Create New Announcement</h1>
    <form method="POST" action="{{ route('annonces.store') }}">
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


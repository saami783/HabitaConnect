<header>
    @extends('welcome')
</header>

@foreach ($announces as $announce)
    <div>
        <p>
            <a href="{{ route('annonces.show', $announce) }}">{{ $announce->title }}</a>
        </p>
    </div>
@endforeach


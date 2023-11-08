<header>
    @extends('welcome')
</header>

@foreach ($announces as $announce)
    <div>
        <p>
            <a href="{{ route('announces.show', $announce) }}">{{ $announce->title }}</a>
        </p>
    </div>
@endforeach


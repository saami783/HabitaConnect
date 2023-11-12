@extends('welcome')

@section('content')
    @foreach ($announces as $announce)
        <div>
            <p><a href="{{ route('announces.show', $announce) }}">{{ $announce->title }}</a></p>
            <p>{{$announce->price }}</p>
            @if($announce->files->isEmpty())
                <p> Aucune images trouvées pour cette annonce. </p>
            @else
                <div>
                    @foreach($announce->files as $file)
                        <img src="{{ asset($file->file_path) }}" alt="Announce Image" style="width:100px; height:auto;">
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach

    <div>
        {{ $announces->links() }}
    </div>
@endsection

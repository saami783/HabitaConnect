@extends('welcome')
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/pagination/pagination_CSS.css')}}" rel="stylesheet" type="text/css">

@section('content')
    @foreach ($announces as $announce)
        <section class="annonce">
            <a href="{{ route('announces.show', $announce) }}">
            @if($announce->files->isEmpty())
                <div class="div_offre_image">
                    <img src="{{asset('images/images/no_image_disponible.svg')}}" alt="sans image" title="Aucune image disponible pour cette offre" class="offre_image">
                </div>
            @else
                @foreach($announce->files as $file)
                    <div class="div_offre_image">
                        <img src="{{ asset($file->file_path) }}" alt="Announce Image" class="offre_image">
                    </div>
                @endforeach
            @endif
            <hr />
            <div class="offre_detail">
                {{ $announce->title }}</a>
                <p><a href="{{ route('announces.show', $announce) }}">{{$announce->price }}</a></p>
        </section>
    @endforeach
    <section id="pagination">
        <div>
            {{ $announces->links() }}
        </div>
    </section>
@endsection



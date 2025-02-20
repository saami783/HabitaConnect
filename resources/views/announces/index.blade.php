@extends('welcome')
<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/pagination/pagination_CSS.css')}}" rel="stylesheet" type="text/css">

@section('content')
    @foreach ($announces as $announce)
        <section class="annonce">
            <div class="div_offre">
                @if($announce->files->isEmpty())
                    <img src="{{asset('images/images/no_image_disponible.svg')}}" alt="sans image" title="Aucune image disponible pour cette offre" class="offre_image">
                @else
                        @foreach($announce->files as $file)
                            <div class="div_offre_image">
{{--                                <img src="{{asset('images/images/1.svg')}}"  id="offre_image1">--}}
{{--                                <img src="{{asset('images/images/2.svg')}}" id="offre_image2">--}}
{{--                                <img src="{{asset('images/images/3.svg')}}"  id="offre_image3">--}}
                                <img src="{{ asset($file->file_path) }}" alt="Announce Image" style="width:100px; height:auto;" class="offre_image">
{{--                            </div>--}}
{{--                                <div class="slider">--}}
{{--                                    <a href="#offre_image1"></a>--}}
{{--                                    <a href="#offre_image2"></a>--}}
{{--                                    <a href="#offre_image3"></a>--}}
{{--                            </div>--}}
                        @endforeach
                @endif
            </div>
            <hr />
            <div class="offre_detail">
                <p><a href="{{ route('announces.show', $announce) }}">{{ $announce->title }}</a></p>
                <p><a href="{{ route('announces.show', $announce) }}">{{$announce->price }}</p>
            </div>
        </section>
    @endforeach
    <section id="pagination">
        <div>
            {{ $announces->links() }}
        </div>
    </section>
@endsection



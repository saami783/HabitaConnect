@extends('welcome')

<link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/pagination/pagination_CSS.css')}}" rel="stylesheet" type="text/css">

@section('content')
    @foreach ($announces as $announce)
        <section class="annonce">
            @if($announce->files->isEmpty())
                <div class="div_offre_image">
                    <a href="{{ route('announces.show', $announce) }}">
                        <img src="{{ asset('images/images/no_image_disponible.svg') }}" alt="sans image" title="Aucune image disponible pour cette offre" class="offre_image">
                    </a>
                </div>
            @else
                <div class="slider-container">
                    @foreach($announce->files as $file)
                        <div class="slide">
                            <img src="{{ asset($file->file_path) }}" alt="Announce Image" class="offre_image">
                        </div>
                    @endforeach
                    <button class="prev">&#10094;</button>
                    <button class="next">&#10095;</button>
                </div>
            @endif
            <hr />
            <div class="offre_detail">
                <a href="{{ route('announces.show', $announce) }}">{{ $announce->title }}</a>
                <p>{{ $announce->price }}</p>
            </div>
        </section>
    @endforeach
    <section id="pagination">
        <div>
            {{ $announces->links() }}
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.annonce').forEach(function (announce) {
                if (announce.querySelector('.slider-container')) {
                    let currentSlide = 0;
                    const slides = announce.querySelectorAll('.slide');
                    const showSlide = (index) => {
                        slides.forEach(slide => slide.style.display = 'none');
                        slides[index].style.display = 'block';
                    };
                    showSlide(currentSlide);

                    announce.querySelector('.prev').addEventListener('click', (e) => {
                        e.preventDefault();
                        currentSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
                        showSlide(currentSlide);
                    });

                    announce.querySelector('.next').addEventListener('click', (e) => {
                        e.preventDefault();
                        currentSlide = currentSlide === slides.length - 1 ? 0 : currentSlide + 1;
                        showSlide(currentSlide);
                    });
                }
            });
        });
    </script>
@endsection

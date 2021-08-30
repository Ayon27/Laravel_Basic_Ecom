@php
use App\Models\Carousel;
$carousels = Carousel::all();

@endphp

<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->

            @foreach ($carousels as $key => $carousel)

            <div class="carousel-item {{ $key == 0 ? "active" : '' }}"
                style="background-image: url({{ asset($carousel->image) }});">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>Welcome to <span>Company</span></h2>
                        <p>{{ $carousel->desc }}</p>
                        <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                    </div>
                </div>
            </div>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum consectetur aliquid inventore? Architecto
            dolorum eaque qui possimus ducimus perspiciatis doloremque odio, quibusdam ipsa nesciunt, consequuntur sunt
            iste perferendis voluptatum soluta.
            @endforeach

        </div>

    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section><!-- End Hero -->

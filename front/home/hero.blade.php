<!-- Hero Section -->
<section id="hero" class="hero section">

  <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2000">

    @php
        $slides = \App\Models\Hero::where('status', 1)->orderBy('order')->get();
    @endphp

    @foreach($slides as $key => $slide)
      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        <img src="{{ asset('storage/' . $slide->image) }}" alt="">
        <div class="container">
          <h2>
            {{ App::getLocale() == 'am' ? $slide->title_am : $slide->title_en }}
          </h2>
          <p>
            {{ App::getLocale() == 'am' ? $slide->description_am : $slide->description_en }}
          </p>
          @if($slide->button_link)
            <a href="{{ $slide->button_link }}" class="btn-get-started">
              {{ App::getLocale() == 'am' ? $slide->button_text_am : $slide->button_text_en }}
            </a>
          @endif
        </div>
      </div><!-- End Carousel Item -->
    @endforeach

    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>

    <ol class="carousel-indicators"></ol>

  </div>

</section><!-- /Hero Section -->

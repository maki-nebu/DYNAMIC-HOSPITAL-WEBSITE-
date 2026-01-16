@php
    // Get the first active CTA section
    $cta = \App\Models\CtaSection::where('status', 1)->first();
@endphp

@if($cta)
<section id="call-to-action" class="call-to-action section accent-background">

  <div class="container">
    <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
      <div class="col-xl-10">
        <div class="text-center">

          @if($cta->title_en || $cta->title_am)
            <h3>{{ App::getLocale() == 'am' ? $cta->title_am : $cta->title_en }}</h3>
          @endif

          @if($cta->description_en || $cta->description_am)
            <p>{{ App::getLocale() == 'am' ? $cta->description_am : $cta->description_en }}</p>
          @endif

          @if($cta->button_link)
            <a class="cta-btn" href="{{ $cta->button_link }}">
              {{ App::getLocale() == 'am' ? $cta->button_text_am : $cta->button_text_en }}
            </a>
          @endif

        </div>
      </div>
    </div>
  </div>

</section><!-- /Call To Action Section -->
@endif

@php
    $locale = app()->getLocale();
    $isAm = substr($locale, 0, 2) === 'am';
@endphp

<!-- Features Section -->
<section id="features" class="features section">
  <div class="container">
    <div class="row justify-content-around gy-4">

      <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ asset('user/assets/img/features.jpg') }}" alt="">
      </div>

      <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <h3>{{ $isAm ? 'ከፍተኛ የጤና አገልግሎቶቻችን' : __('Our Best Services') }}</h3>
        <p>{{ $isAm ? 'ታላቅ የጤና አገልግሎት ለታካሚዎቻችን እንሰጣለን። የተፈለገውን አገልግሎት ለተጨማሪ መረጃ ይምረጡ።' : __('We provide top-notch healthcare services to our patients. Choose any service below to learn more.') }}</p>

        @foreach($services as $service)
          <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="{{ 300 + $loop->iteration * 100 }}">
            <i class="{{ $service->icon }} flex-shrink-0"></i>
            <div>
              <h4>
<a href="{{ route('services.show', $service->id) }}" class="stretched-link">
    {{ $isAm ? $service->name_am : $service->name_en }}
</a>

              </h4>
              <p>
                {{ $isAm 
                    ? \Illuminate\Support\Str::words($service->description_am, 15, '...') 
                    : \Illuminate\Support\Str::words($service->description_en, 15, '...') }}
              </p>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>
</section><!-- /Features Section -->

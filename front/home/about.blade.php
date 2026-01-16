<!-- About Section -->
<section id="about" class="about section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    @php
    $locale = app()->getLocale();
    $isAm = substr($locale, 0, 2) === 'am';
@endphp

<h2>
    {{ $isAm ? 'ስለ እኛ' : __('About Us') }}<br>
</h2>

   <p class="about-text">
    {{ $description ? (app()->getLocale() == 'am' ? $description->content_am : $description->content_en) : 'Providing exceptional healthcare with compassion, expertise, and innovation.' }}
</p>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4">
      <!-- Left Section: History Video -->
      <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ $hospitalHistory ? asset('storage/'.$hospitalHistory->image) : 'user/assets/img/about.jpg' }}" class="img-fluid" alt="">
        @if($hospitalHistory && $hospitalHistory->history_video)
          <a href="{{ $hospitalHistory->history_video }}" class="glightbox pulsating-play-btn"></a>
        @endif
      </div>

      <!-- Right Section: Mission, Vision, Core Values -->
      <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">

        @if($mission)
          <h4>{{ app()->getLocale() == 'am' ? $mission->title_am : $mission->title_en }}</h4>
          <p>{{ app()->getLocale() == 'am' ? $mission->content_am : $mission->content_en }}</p>
        @endif

        @if($vision)
          <h4>{{ app()->getLocale() == 'am' ? $vision->title_am : $vision->title_en }}</h4>
          <p>{{ app()->getLocale() == 'am' ? $vision->content_am : $vision->content_en }}</p>
        @endif

        @if($coreValues)
          <h4>{{ app()->getLocale() == 'am' ? $coreValues->title_am : $coreValues->title_en }}</h4>
          <p>{{ app()->getLocale() == 'am' ? $coreValues->content_am : $coreValues->content_en }}</p>
        @endif

        <!-- Read More Button -->
      <a href="{{ route('about.page') }}" class="btn" 
   style="background-color:#3fbbc0; color:white; font-weight:bold; padding:0.75rem 1.5rem; border-radius:0.5rem;">
    {{ $isAm ? 'ተጨማሪ ያንብቡ' : __('Read More') }} &gt;&gt;
</a>

      </div>
    </div>
  </div>

</section><!-- /About Section -->
<style>
  .about-text {
    font-size: 16px;       /* normal readable size */
    line-height: 1.6;      /* nice spacing */
    margin-bottom: 1rem;   /* optional spacing under paragraph */
    color: #555;           /* optional text color */
}
</style>

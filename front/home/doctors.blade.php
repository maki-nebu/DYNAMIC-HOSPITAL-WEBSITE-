@php
    $locale = app()->getLocale();
    $isAm = substr($locale, 0, 2) === 'am';
@endphp

<!-- Doctors Section -->
<section id="doctors" class="doctors section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>{{ $isAm ? 'ዶክተሮች' : 'Doctors' }}</h2>
    <p>{{ $isAm ? 'ከእኛ ጋር የሕክምና ባለሙያዎቻችንን ያገኙ' : 'Meet some of our dedicated medical professionals' }}</p>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4">

      @foreach($doctors->take(4) as $doctor)
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="team-member shadow-sm rounded">
            <div class="member-img position-relative overflow-hidden">
              <img src="{{ asset('storage/doctors/' . $doctor->image) }}"
                   class="img-fluid" alt="{{ $doctor->{'name_' . app()->getLocale()} }}" loading="lazy">
              <div class="social position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="background: rgba(0,0,0,0.5); opacity:0; transition:0.3s;">
                <a href="#"><i class="bi bi-twitter text-white mx-2"></i></a>
                <a href="#"><i class="bi bi-facebook text-white mx-2"></i></a>
                <a href="#"><i class="bi bi-instagram text-white mx-2"></i></a>
                <a href="#"><i class="bi bi-linkedin text-white mx-2"></i></a>
              </div>
            </div>
            <div class="member-info mt-3 text-center">
              <h4>{{ $doctor->{'name_' . app()->getLocale()} }}</h4>
              <span>{{ $doctor->{'speciality_' . app()->getLocale()} }}</span>
            </div>
          </div>
        </div><!-- End Team Member -->
      @endforeach

    </div><!-- End Row -->

    <!-- See All Doctors Button -->
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="{{ route('doctors.all') }}" 
         class="btn btn-lg" 
         style="background-color:#3fbbc0; color:white; border-radius:30px; padding:10px 25px; font-weight:600; transition:0.3s;">
        {{ $isAm ? 'ሁሉንም ዶክተሮች ይመልከቱ' : 'See All Doctors' }}
      </a>
    </div>

  </div><!-- End Container -->

</section><!-- /Doctors Section -->

<!-- Optional CSS for hover effects -->
<style>
  .team-member .member-img:hover .social {
    opacity: 1;
  }
  .btn:hover {
    background-color: #35a9a8 !important;
    color: white !important;
  }
</style>

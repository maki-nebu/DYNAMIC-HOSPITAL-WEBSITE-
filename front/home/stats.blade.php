@php
    $locale = app()->getLocale();
    $isAm = substr($locale, 0, 2) === 'am';
@endphp

<!-- Stats Section -->
<section id="stats" class="stats section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="fas fa-user-md flex-shrink-0"></i>
          <div>
            <span data-purecounter-end="{{ $doctorCount }}" class="purecounter"></span>
            <p>{{ $isAm ? 'ዶክተሮች' : 'Doctors' }}</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="far fa-hospital flex-shrink-0"></i>
          <div>
            <span data-purecounter-end="{{ $departmentCount }}" class="purecounter"></span>
            <p>{{ $isAm ? 'የጽ/ቤቶች' : 'Departments' }}</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="fas fa-flask flex-shrink-0"></i>
          <div>
            <span data-purecounter-end="{{ $serviceCount }}" class="purecounter"></span>
            <p>{{ $isAm ? 'አገልግሎቶች' : 'Services' }}</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item d-flex align-items-center w-100 h-100">
          <i class="fas fa-award flex-shrink-0"></i>
          <div>
            <span data-purecounter-end="{{ $accreditationCount }}" class="purecounter"></span>
            <p>{{ $isAm ? 'ማረጋገጫዎች እና ሽልማቶች' : 'Accreditations & Awards' }}</p>
          </div>
        </div>
      </div><!-- End Stats Item -->

    </div>

  </div>

</section><!-- /Stats Section -->

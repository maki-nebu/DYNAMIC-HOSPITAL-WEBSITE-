@php
  $locale = app()->getLocale();
@endphp

<section id="tabs" class="tabs section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>{{ $locale === 'am' ? 'ትምህርት ቤቶች' : 'Departments' }}</h2>
    <p>{{ $locale === 'am' ? 'አስፈላጊ ክፍሎች እና አገልግሎቶችን ይያዙ' : 'Explore our departments and services' }}</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">

      <!-- Sidebar -->
      <div class="col-lg-3">
        <ul class="nav nav-tabs flex-column">
          @foreach ($departments as $department)
            <li class="nav-item">
              <a class="nav-link {{ $loop->first ? 'active show' : '' }}"
                 data-bs-toggle="tab"
                 href="#tabs-tab-{{ $department->id }}">
                {{ $locale === 'am' ? $department->department_name_am : $department->department_name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <!-- Tab Content -->
      <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="tab-content">
          @foreach ($departments as $department)
            <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="tabs-tab-{{ $department->id }}">
              <div class="row align-items-center">

                <!-- Details Left -->
                <div class="col-lg-8 order-2 order-lg-1">
                  <h3>{{ $locale === 'am' ? $department->department_name_am : $department->department_name }}</h3>
                  <p class="fst-italic">
                    {{ $locale === 'am' ? ($department->description_am ?? 'መግለጫ የለም።') : ($department->description ?? 'No description available.') }}
                  </p>

                  <!-- Director / Vice Director -->
                  <div class="mt-3">
                    @if($locale === 'am')
                      @if($department->director_name_am)
                        <p><strong>የክፍል ዳይሬክተር:</strong> {{ $department->director_name_am }}</p>
                      @endif
                      @if($department->vice_director_am)
                        <p><strong>የክፍል የአስተዳደር ዳይሬክተር:</strong> {{ $department->vice_director_am }}</p>
                      @endif
                    @else
                      @if($department->director_name)
                        <p><strong>Director:</strong> {{ $department->director_name }}</p>
                      @endif
                      @if($department->vice_director)
                        <p><strong>Vice Director:</strong> {{ $department->vice_director }}</p>
                      @endif
                    @endif
                  </div>
                </div>

                <!-- Image Right -->
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  @php
                    $img = $department->department_photo ?? $department->image ?? 'user/assets/img/default-department.jpg';
                  @endphp
                  <img src="{{ asset('storage/' . $img) }}"
                       alt="{{ $locale === 'am' ? $department->department_name_am : $department->department_name }}"
                       class="img-fluid rounded shadow-sm department-img">
                </div>

              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>

</section>

{{-- Add this to your styles section --}}
@section('styles')
<style>
.department-img {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.department-img:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
</style>
@stop

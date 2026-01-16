@extends('front.layouts.app_white')

@section('content')

@php
    $locale = app()->getLocale();
    $isAm = substr($locale, 0, 2) === 'am';

    // Service translations
    $serviceName = $isAm ? ($service->name_am ?? $service->name_en) : ($service->name_en ?? $service->name_am);
    $serviceDesc = $isAm ? ($service->description_am ?? $service->description_en) : ($service->description_en ?? $service->description_am);

    // Department translations (if exists)
    if($department) {
        $deptName = $isAm ? ($department->department_name_am ?? $department->department_name_en ?? $department->department_name) 
                          : ($department->department_name_en ?? $department->department_name_am ?? $department->department_name);
        $deptDesc = $isAm ? ($department->description_am ?? $department->description_en) 
                          : ($department->description_en ?? $department->description_am);
    }
@endphp

<!-- Hero Section -->
<section class="service-hero text-white" style="background-image: url('{{ asset('storage/'.$service->image) }}');">
    <div class="overlay">
        <div class="container text-center">
            <h1 class="display-3 fw-bold">{{ $serviceName }}</h1>
            <p class="lead">{{ $department ? $deptName : ($isAm ? 'አጠቃላይ አገልግሎት' : 'General Service') }}</p>
             <a href="{{ route('services.frontend') }}" class="back-button">
                        <i class="fas fa-arrow-left me-2"></i> {{ $isAm ? 'ለሁሉም አገልግሎቶች ተመለስ' : 'Back to all services' }}
                    </a>
        </div>
    </div>
</section>

<!-- Service Description with Department Slider -->
<section class="py-5">
    <div class="container">
        <div class="row service-description">
            
            <!-- Description -->
            <div class="col-lg-7 d-flex flex-column justify-content-start">
                <h2>{{ $isAm ? 'ስለ ዚህ አገልግሎት' : 'About this Service' }}</h2>
                <p>{!! nl2br(e($serviceDesc)) !!}</p>
            </div>

            <!-- Department Slider -->
            <div class="col-lg-5 d-flex align-items-stretch mt-4 mt-lg-0">
                <div class="swiper department-swiper w-100">
                    <div class="swiper-wrapper">
@if($galleries && $galleries->count())
    @foreach($galleries as $gallery)
        <div class="swiper-slide">
            <img src="{{ asset('storage/galleries/'.$gallery->image) }}"
                 alt="{{ $isAm ? ($gallery->name_am ?? $gallery->name) : ($gallery->name_en ?? $gallery->name) }}"
                 class="slider-img">
        </div>
    @endforeach
@else
    {{-- Optional fallback for general services --}}
    {{-- <p class="text-muted">No galleries available for this service.</p> --}}
@endif

                    </div>
                    <!-- Pagination & Navigation -->
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- Galleries -->
@php
    $displayGalleries = $department
        ? $department->galleries
        : \App\Models\Gallery::whereNull('department_id')->get();
@endphp

@if($displayGalleries->count() > 0)
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">{{ $isAm ? 'የማዕከላዊ ማሳያ ምርጦች' : 'Gallery Highlights' }}</h2>
        <div class="row g-4">
            @foreach($displayGalleries as $gallery)
                <div class="col-md-4 col-sm-6">
                    <div class="gallery-card">
                        <img src="{{ asset('storage/galleries/'.$gallery->image) }}"
                             alt="{{ $isAm ? ($gallery->name_am ?? $gallery->name) : ($gallery->name_en ?? $gallery->name) }}"
                             class="gallery-img">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="cta-modern py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="cta-box shadow-lg rounded-4 p-5 bg-white">
                    <h2 class="fw-bold mb-3 text-primary">
                        {{ $isAm ? 'ስለ ' . $serviceName . ' ጥያቄዎች አሉ?' : 'Have Questions About ' . $serviceName . '?' }}
                    </h2>
                    <p class="mb-4 text-muted">
                        {{ $isAm 
                            ? 'ቡድናችን በዝርዝር መረጃ፣ መመሪያ እና ድጋፍ ለማቅረብ ዝግጁ ነው። ዛሬም እንደገና እያገኙ።' 
                            : 'Our team is ready to assist you with detailed information, guidance, and support. Don’t hesitate to get in touch with us today.' 
                        }}
                    </p>
                    <a href="{{ route('contacts.index') }}" class="btn btn-lg btn-primary px-4">
                        <i class="bi bi-envelope-fill me-2"></i> {{ $isAm ? 'አሁን ያነጋግሩን' : 'Contact Us Now' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* --- NO CHANGES MADE BELOW --- */
.service-hero {
    background-size: cover;
    background-position: center;
    position: relative;
    min-height: 85vh;
    display: flex;
    align-items: center;
}
.service-hero .overlay {
    background: rgba(0,0,0,0.55);
    width: 100%;
    padding: 80px 20px;
}
        .back-button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .back-button:hover {
            background: #0d47a1;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 71, 161, 0.3);
        }
.gallery-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}
.gallery-img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    transition: transform .3s ease;
}
.gallery-card:hover .gallery-img {
    transform: scale(1.1);
}
/* Modern CTA Section */
.cta-modern {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe, #dbeafe);
    padding: 80px 20px;
}

.cta-box {
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: transform .3s ease, box-shadow .3s ease;
}

.cta-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
}

.cta-box h2 {
    font-size: 2rem;
    color: #1e3a8a;
}

.cta-box p {
    font-size: 1.1rem;
}

.cta-box .btn-primary {
    background: #3fbbc0;
    border: none;
    border-radius: 50px;
    font-weight: 600;
}

.cta-box .btn-primary:hover {
    background: #359ba0;
}

.service-description {
    display: flex;
    flex-wrap: wrap;
}
.service-description .col-lg-5 {
    display: flex;
}
.department-swiper {
    width: 100%;
    height: 100%;
}
.department-swiper .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0.5rem;
}
.service-description {
    align-items: stretch;
}
.slider-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 12px;
}

/* Slider styles */
.department-swiper {
    width: 100%;
    height: auto;
    max-height: 600px; /* cap height */
}

.department-swiper .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0.5rem;
}

@media (min-width: 992px) {
    .department-swiper {
        height: 100%;
    }
}
@media (max-width: 991px) {
    .col-lg-5 {
        margin-top: 20px;
    }
}
</style>
@endpush

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

@push('scripts')
<script>
const departmentSwiper = new Swiper('.department-swiper', {
    effect: 'fade',
    fadeEffect: { crossFade: true },
    slidesPerView: 1,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

// Adjust swiper height to match description dynamically (with max cap)
window.addEventListener('load', adjustSwiperHeight);
window.addEventListener('resize', adjustSwiperHeight);

function adjustSwiperHeight() {
  const description = document.querySelector('.col-lg-7');
  const swiperEl = document.querySelector('.department-swiper');
  if (window.innerWidth >= 992) {
    let descHeight = description.offsetHeight;
    swiperEl.style.height = Math.min(descHeight, 600) + 'px'; // cap at 600px
  } else {
    swiperEl.style.height = '300px'; // reasonable default for mobile
  }
}
</script>
@endpush

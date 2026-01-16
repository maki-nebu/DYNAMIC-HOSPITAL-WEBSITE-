@extends('front.layouts.app_white')

@section('content')
<section id="servicesPortal" class="services-portal bg-white">

<!-- Hero Section -->
<div class="hero" style="position: relative; background-image: url('{{ asset('assets/images/new_folder/sample1.jpg') }}'); background-size: cover; background-position: center; height: 80vh; display: flex; align-items: center; justify-content: center; text-align: center;">

    <!-- Content -->
    <div style="position: relative; z-index: 2; max-width: 1300px; padding: 100px 95px; background: rgba(0,0,0,0.4); border-radius: 12px;">
        <h1 class="hero-title" style="color: #f7f7f7ff; font-weight: 700; font-size: 5rem;">
            {{ __('services.hero_title') }}
        </h1>
        <p class="hero-subtitle" style="color: #fff; margin-top: 15px; font-size: 1.3rem;">
           {{ __('services.hero_subtitle') }}
        </p>
    </div>
</div>


    <div class="container py-5">
        <h2 class="section-title text-center mb-3">{{ __('services.title') }}</h2>
        <p class="section-subtitle text-center mb-5">{{ __('services.subtitle') }}</p>

        <!-- Filter Buttons -->
        <div class="text-center mb-5">
            <button class="btn btn-outline-primary m-1 filter-btn active" data-filter="all">{{ __('All') }}</button>
            @foreach($departments as $department)
                <button class="btn btn-outline-primary m-1 filter-btn" data-filter="department-{{ $department->id }}">
                    {{ $department->department_name }}
                </button>
            @endforeach
            @if(isset($generalServices) && $generalServices->count() > 0)
                <button class="btn btn-outline-primary m-1 filter-btn" data-filter="general">General Services</button>
            @endif
        </div>

        @php
            $flat = [];
            foreach($departments as $department) {
                foreach($department->services as $s) {
                    $flat[] = ['service' => $s, 'dept_class' => 'department-' . $department->id];
                }
            }
            if (isset($generalServices)) {
                foreach($generalServices as $s) {
                    $flat[] = ['service' => $s, 'dept_class' => 'general'];
                }
            }
        @endphp

        <div id="serviceList">
            @foreach($flat as $i => $item)
                @php
                    $service = $item['service'];
                    $deptClass = $item['dept_class'];
                    $visibleClass = $i < 6 ? '' : 'd-none extra-service';
                    $initialReverse = ($i % 2) ? 'reverse' : '';

                    // Locale-aware selection (robust to locale codes like "am" or "am-ET")
                    $locale = app()->getLocale();
                    $isAm = substr($locale, 0, 2) === 'am';

                    $serviceName = $isAm
                        ? ($service->name_am ?? $service->name_en ?? $service->name ?? '')
                        : ($service->name_en ?? $service->name_am ?? $service->name ?? '');

                    $serviceDesc = $isAm
                        ? ($service->description_am ?? $service->description_en ?? $service->description ?? '')
                        : ($service->description_en ?? $service->description_am ?? $service->description ?? '');
                @endphp
                <div class="service-item {{ $visibleClass }} {{ $initialReverse }} {{ $deptClass }}" data-department="{{ $deptClass }}">
                    <div class="service-inner">
                        <div class="service-image">
                            <img src="{{ asset('storage/' . $service->image) }}"
                                 alt="{{ $serviceName }}"
                                 onerror="this.src='{{ asset('assets/images/New folder/service5.jpg') }}'"
                                 class="service-img"
                                 loading="lazy">
                        </div>
                        <div class="service-desc">
                            <div class="desc-container">
                                <h3>{{ $serviceName }}</h3>
                                <p>{{ \Illuminate\Support\Str::words(strip_tags($serviceDesc), 35, '...') }}</p>
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-primary">{{ __('services.Learn More') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Plain load more link -->
        <div class="text-center mt-4">
            <a href="#" id="loadMoreLink">{{ __('services.Load more services') }}</a>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const items = Array.from(document.querySelectorAll('.service-item'));
    const filterButtons = document.querySelectorAll('.filter-btn');
    const loadMoreLink = document.getElementById('loadMoreLink');

    const STEP = 6;
    let visibleCount = STEP;
    let activeFilter = 'all';

    function getFiltered() {
        return activeFilter === 'all'
            ? items
            : items.filter(it => it.dataset.department === activeFilter);
    }

    function render() {
        const filtered = getFiltered();
        items.forEach(it => it.classList.add('d-none'));

        filtered.forEach((it, idx) => {
            if (idx < visibleCount) {
                it.classList.remove('d-none');
            }
            if (idx % 2 === 1) it.classList.add('reverse');
            else it.classList.remove('reverse');
        });

        loadMoreLink.style.display = filtered.length > visibleCount ? 'inline-block' : 'none';
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeFilter = this.dataset.filter;
            visibleCount = STEP;
            render();
        });
    });

    loadMoreLink.addEventListener('click', function (e) {
        e.preventDefault();
        visibleCount += STEP;
        render();
    });

    render();
});
</script>

<style>
.hero {
    position: relative;
    min-height: 85vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.hero-overlay {
    padding: 60px 20px;
    text-align: center;
    border-radius: 12px;
    /* Optional: remove background for fully visible image */
    background: transparent;
    color:  #f7f7f7f;
}

.hero-overlay {
    padding: 60px 20px;
    text-align: center;
    border-radius: 12px;
    background: transparent; /* keep image fully visible */
    color: #f7f7f7f; /* black text */
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 1px 1px 5px rgba(255, 255, 255, 0.6); /* subtle shadow for readability */
    color: #fff;
}

.hero-subtitle {
    font-size: 1.5rem;
    font-weight: 400;
    text-shadow: 1px 1px 5px rgba(255, 255, 255, 0.6);
    color: #fff;
}

.chips span {
    background: rgba(0, 0, 0, 0.05); /* subtle light background so black text stands out */
    color: #3fbbc0;
    border-radius: 50px;
    padding: 6px 15px;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s;
}

.chips span:hover {
    background: #3fbbc0;
    color: #fff;
    cursor: default;
}

.service-item { margin-bottom:3rem; }
.service-inner { display:flex; align-items:center; gap:30px; }
.service-item.reverse .service-inner { flex-direction: row-reverse; }

/* Smaller images */
.service-image { flex:0 0 28%; max-width:360px; }
.service-img { width:100%; height:380px; object-fit:cover; border-radius:18px; box-shadow:0 10px 25px rgba(0,0,0,0.15); }

.service-desc { flex:1; }
.desc-container { background:#fff; padding:22px 26px; border-radius:50px; box-shadow:0 6px 18px rgba(0,0,0,0.05); }
.desc-container h3 { margin-bottom:.5rem; }
.desc-container p { margin-bottom:1rem; }

/* Load more link styling */
#loadMoreLink { color:#007bff; text-decoration:underline; cursor:pointer; }

@media(max-width: 991px){
  .service-inner{ flex-direction:column; }
  .service-image{ flex:1 1 100%; max-width:100%; }
  .service-img{ height:260px; }
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .hero-title {
        font-size: 2.5rem;
    }
    .hero-subtitle {
        font-size: 1.2rem;
    }
}

@media (max-width: 575px) {
    .hero-title {
        font-size: 2rem;
    }
    .hero-subtitle {
        font-size: 1rem;
    }
    .chips span {
        font-size: 0.85rem;
        padding: 5px 10px;
    }
}
</style>
@endsection

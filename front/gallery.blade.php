{{-- resources/views/front/gallery.blade.php --}}
@extends('front.layouts.app_white')

@section('title', __('gallery.title', [], app()->getLocale() ?: null))

@section('content')

{{-- ---------- HERO ---------- --}}
<section class="gallery-hero py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                {{-- translation keys: gallery.hero_title, gallery.hero_subtitle --}}
                <h1 class="display-4 fw-bold mb-3 text-dark">{{ __('gallery.hero_title') }}</h1>
                <p class="lead mb-4 text-secondary">{{ __('gallery.hero_subtitle') }}</p>

                <div class="hero-stats d-flex justify-content-center flex-wrap gap-4">
                    <div class="stat-item px-3 py-2 rounded" style="background: rgba(108, 117, 125, 0.12);">
                        <h3 class="fw-bold mb-0 text-dark">{{ $galleries->count() }}</h3>
                        <p class="mb-0 small text-secondary">{{ __('gallery.total_media') }}</p>
                    </div>
                    <div class="stat-item px-3 py-2 rounded" style="background: rgba(108, 117, 125, 0.12);">
                        <h3 class="fw-bold mb-0 text-dark">{{ $galleries->where('type','image')->count() }}</h3>
                        <p class="mb-0 small text-secondary">{{ __('gallery.photos') }}</p>
                    </div>
                    <div class="stat-item px-3 py-2 rounded" style="background: rgba(108, 117, 125, 0.12);">
                        <h3 class="fw-bold mb-0 text-dark">{{ $galleries->where('type','video')->count() }}</h3>
                        <p class="mb-0 small text-secondary">{{ __('gallery.videos') }}</p>
                    </div>
                    <div class="stat-item px-3 py-2 rounded" style="background: rgba(108, 117, 125, 0.12);">
                        <h3 class="fw-bold mb-0 text-dark">{{ $departments->count() }}</h3>
                        <p class="mb-0 small text-secondary">{{ __('gallery.departments') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ---------- MAIN CONTENT ---------- --}}
<section class="gallery-section py-3">
    <div class="container">
<div class="row">
    {{-- Sidebar --}}
    <aside class="col-lg-3 mb-4">
        <div class="sidebar-sticky scrollable-sidebar">
                        {{-- SIDEBAR: Departments + Years --}}

                    <div class="department-filter p-4 rounded shadow-sm bg-white">
                        <h5 class="mb-3 text-dark">{{ __('gallery.filter_by_department') }}</h5>
                        <div class="list-group" id="department-filter">
                            <a href="javascript:void(0)" data-department="all"
                               class="list-group-item list-group-item-action active">
                                {{ __('gallery.all_departments') }}
                                <span class="badge bg-info rounded-pill">{{ $totalGalleryCount ?? $galleries->count() }}</span>
                            </a>
                            @foreach($departments as $department)
                                @php
                                    $deptName = transField($department->department_name);
                                    $count = $department->galleries_count ?? 0;
                                @endphp
                                <a href="javascript:void(0)" data-department="{{ $department->id }}" 
                                   class="list-group-item list-group-item-action">
                                    {{ $deptName }}
                                    <span class="badge bg-info rounded-pill">{{ $count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="year-filter mt-4 p-4 rounded shadow-sm bg-white">
                        <h5 class="mb-3 text-dark">{{ __('gallery.filter_by_year') }}</h5>
                        <div class="list-group" id="year-filter">
                            <a href="javascript:void(0)" data-year="all"
                               class="list-group-item list-group-item-action active">
                               {{ __('gallery.all_Years') }}
                            </a>
                            @foreach($years as $year)
<a href="javascript:void(0)" data-year="{{ (string)$year }}" 
   class="list-group-item list-group-item-action">
   {{ $year }}
</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>


    {{-- Gallery Grid --}}
    <div class="col-lg-9">
        <div class="gallery-grid-wrapper scrollable-grid">

                {{-- Type filter centered at top of grid --}}
        <div class="type-filter mb-4 d-flex justify-content-end" id="type-filter">
            <div class="btn-group" role="group" aria-label="Type Filter">
                <a href="javascript:void(0)" data-type="all" class="btn btn-outline-info active">{{ __('gallery.all') }}</a>
                <a href="javascript:void(0)" data-type="image" class="btn btn-outline-info">{{ __('gallery.photos') }}</a>
                <a href="javascript:void(0)" data-type="video" class="btn btn-outline-info">{{ __('gallery.videos') }}</a>
            </div>
        </div>

            <div class="row g-4" id="gallery-grid">
                @foreach($galleries as $gallery)
        <div class="col-md-6 col-lg-4 gallery-item"
             data-type="{{ strtolower($gallery->type) }}"
             data-department="{{ $gallery->department ? $gallery->department->id : 'all' }}"
             data-year="{{ $gallery->year ?? 'all' }}"> {{-- <-- use $gallery->year here --}}
            <div class="card h-100 gallery-card">
                @if($gallery->type === 'image')
                    <img src="{{ asset('storage/galleries/'.$gallery->image) }}" alt="Test" style="height:230px;">
                @elseif($gallery->type === 'video')
                    @php
                        $videoUrl = $gallery->video_url;
                        if (Str::contains($videoUrl, 'youtube.com/shorts')) {
                            $id = last(explode('/', $videoUrl));
                            $videoUrl = "https://www.youtube.com/embed/".$id;
                        }
                        if (Str::contains($videoUrl, 'watch?v=')) {
                            $id = explode('watch?v=', $videoUrl)[1];
                            $videoUrl = "https://www.youtube.com/embed/".$id;
                        }
                    @endphp
                    <div class="ratio ratio-16x9">
                        <iframe width="560" height="315" src="{{ $videoUrl }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif
                <div class="card-body">
                    <h6 class="card-title text-truncate">{{ $gallery->name }}</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>{{ $gallery->department ? $gallery->department->department_name : 'General' }}</small>
                        <small>{{ $gallery->year ?? '' }}</small> {{-- <-- show actual year --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
              
            </div>
        </div>
    </div>
</div>

    </div>
</section>
@stop

@push('styles')
<style>

    /* ---------- HERO ---------- */
.gallery-hero { 
    position: relative; 
    overflow: hidden; 
    padding: 6rem 0 4rem; 
    background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
}

/* SVG wave overlay - more visible */
.gallery-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23000000' fill-opacity='0.15' d='M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,224C672,235,768,181,864,160C960,139,1056,149,1152,138.7C1248,128,1344,96,1392,80L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover; 
    background-position: bottom; 
    opacity: 0.8; /* stronger than before */
    pointer-events: none;
}

/* Hero text */
.gallery-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
    animation: fadeInUp 0.8s ease forwards;
    opacity: 0;
    letter-spacing: 0.5px;
    text-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

.gallery-hero p {
    font-size: 1.25rem;
    color: #495057;
    animation: fadeInUp 1s ease forwards;
    opacity: 0;
    animation-delay: 0.2s;
    letter-spacing: 0.3px;
}

/* Stats boxes */
.hero-stats .stat-item {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(6px); /* glass effect */
    border-radius: 12px;
    padding: 1rem 1.2rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hero-stats .stat-item:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 14px 28px rgba(0,0,0,0.12);
}

.hero-stats h3 {
    font-weight: 700;
    color: #1f2937;
}

.hero-stats p {
    font-size: 0.875rem;
    color: #6c757d;
}

/* Hero animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gallery-hero h1 { font-size: 2.25rem; }
    .gallery-hero p { font-size: 1rem; }
    .hero-stats { flex-direction: column; gap: 1rem; }
}

    /* ---------- Gallery Page Styles ---------- */
    /* Sidebar */
    .sidebar-sticky {
        position: sticky;
        top: 90px;
    }

    .department-filter, .year-filter {
        border: 1px solid #dee2e6;
    }

    .list-group-item {
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .list-group-item.active {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: #fff;
    }

    /* Type filter buttons */
    .type-filter .btn {
        border-radius: 30px;
        padding: 0.35rem 1.2rem;
        font-size: 0.9rem;
        transition: all 0.2s ease-in-out;
    }

    .type-filter .btn.active {
        background-color: #17a2b8;
        color: #fff;
    }

    /* Gallery cards */
    .gallery-item .card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .gallery-item .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .gallery-item img {
        object-fit: cover;
        height: 220px;
    }

    /* Empty message */
    .no-results {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }

    .no-results i {
        font-size: 2rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    /* Sidebar scroll */
.scrollable-sidebar {
    max-height: 80vh; /* adjust as needed */
    overflow-y: auto;
    padding-right: 10px; /* optional for scrollbar spacing */
}
.scrollable-sidebar::-webkit-scrollbar,
.scrollable-grid::-webkit-scrollbar {
    width: 8px;
}

.scrollable-sidebar::-webkit-scrollbar-thumb,
.scrollable-grid::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0,0.3);
    border-radius: 4px;
}
/* Center type filter above grid */
.type-filter {
    margin-bottom: 1rem;
}
.type-filter .btn {
    border-radius: 15px;
    padding: 0.35rem 1.2rem;
    font-size: 0.9rem;
    transition: all 0.2s ease-in-out;
}
.type-filter .btn.active {
    background-color: #17a2b8;
    color: #fff;
}

  /* Enhanced smooth transitions for filtering */
    #gallery-grid {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .gallery-item {
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        animation: fadeInScale 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    .gallery-item[style*="display: none"] {
        animation: fadeOutScale 0.4s cubic-bezier(0.55, 0.085, 0.68, 0.53) forwards;
        pointer-events: none;
    }

    @keyframes fadeInScale {
        0% {
            opacity: 0;
            transform: scale(0.8) translateY(20px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes fadeOutScale {
        0% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        100% {
            opacity: 0;
            transform: scale(0.8) translateY(20px);
        }
    }

    /* Smooth transition for the no-results message */
    .no-results {
        animation: fadeInUp 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    /* Enhanced card hover effects */
    .gallery-card {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform-origin: center;
    }

    .gallery-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    /* Smooth active state transitions for filters */
    .list-group-item, .type-filter .btn {
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform-origin: center;
    }

    .list-group-item.active, .type-filter .btn.active {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
    }


</style>
@endpush


@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const departmentLinks = document.querySelectorAll("#department-filter .list-group-item");
    const yearLinks = document.querySelectorAll("#year-filter .list-group-item");
    const typeLinks = document.querySelectorAll("#type-filter .btn");
    const galleryItems = document.querySelectorAll("#gallery-grid .gallery-item");
    const galleryGrid = document.querySelector("#gallery-grid");

    let activeDepartment = "all";
    let activeYear = "all";
    let activeType = "all";

    function filterGallery() {
        let visibleCount = 0;

        // Add slight delay for smoother visual transition
        galleryGrid.style.opacity = '0.7';
        galleryGrid.style.transition = 'opacity 0.3s ease';

        galleryItems.forEach(item => {
            const itemDepartment = item.getAttribute("data-department");
            const itemYear = String(item.getAttribute("data-year"));
            const itemType = item.getAttribute("data-type");

            const matchesDepartment = (activeDepartment === "all" || activeDepartment === itemDepartment);
            const matchesYear = (activeYear === "all" || activeYear === itemYear);
            const matchesType = (activeType === "all" || activeType === itemType);

            if (matchesDepartment && matchesYear && matchesType) {
                item.style.display = "";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        // Restore opacity after filter completes
        setTimeout(() => {
            galleryGrid.style.opacity = '1';
        }, 400);

        const existing = document.querySelector(".no-results");
        if (visibleCount === 0) {
            if (!existing) {
                const noResults = document.createElement("div");
                noResults.className = "no-results";
                noResults.innerHTML = `<i class="bi bi-emoji-frown"></i> {{ __('gallery.no_results') }}`;
                galleryGrid.appendChild(noResults);
            }
        } else if (existing) {
            existing.style.animation = 'fadeOutScale 0.4s ease forwards';
            setTimeout(() => {
                if (existing.parentNode) {
                    existing.remove();
                }
            }, 400);
        }
    }

    function setActive(elements, selected) {
        elements.forEach(el => el.classList.remove("active"));
        selected.classList.add("active");
    }

    // Department filter
    departmentLinks.forEach(link => {
        link.addEventListener("click", () => {
            activeDepartment = link.getAttribute("data-department");
            setActive(departmentLinks, link);
            filterGallery();
        });
    });

    // Year filter
    yearLinks.forEach(link => {
        link.addEventListener("click", function() {
            yearLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            activeYear = String(this.getAttribute('data-year') || 'all'); // string
            filterGallery();
        });
    });

    // Type filter
    typeLinks.forEach(link => {
        link.addEventListener("click", () => {
            activeType = link.getAttribute("data-type");
            setActive(typeLinks, link);
            filterGallery();
        });
    });
});
</script>
@endpush

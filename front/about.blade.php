@php 
    $locale = request()->get('lang', 'en'); // default English
    App::setLocale($locale);
@endphp

@php
    $descriptionEntry = $aboutEntries->firstWhere('type', 'description');
@endphp

@extends('front.layouts.app_white')

@section('content')

<!-- ===================== About Us Section ===================== -->
<section class="py-5" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="display-4 fw-bold" style="color:#3fbbc0;">{{ __('about.about_us') }}</h2>
                
                @php 
                    $descriptionEntry = $aboutEntries->firstWhere('type', 'description');
                @endphp
                @if($descriptionEntry)
                    <p class="lead text-secondary">{{ $locale === 'am' ? $descriptionEntry->content_am : $descriptionEntry->content_en }}</p>
                @endif
            </div>
        </div>

        <div class="row align-items-center gy-4">
            <div class="row gy-4 gy-lg-0 align-items-lg-center about-row">
                <!-- Left Image with Overlay -->
                <div class="col-12 col-lg-6 p-0">
                    <div class="about-img-wrapper">
                        <img src="{{ isset($descriptionEntry->image) ? asset('storage/' . $descriptionEntry->image) : asset('assets/images/doctors/hospital.jpg') }}" 
                             alt="{{ __('About Us') }}">
                        <div class="about-overlay">
                            <h3 class="fw-bold">{{ __('about.trusted_healthcare') }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Right Text -->
                <div class="col-12 col-lg-6 col-xxl-6">
                    <div class="about-wrapper p-4">
                        @php 
                            $missionEntry = $aboutEntries->firstWhere('type', 'mission');
                            $doctorsCount = \App\Models\Doctor::count();
                            $accreditationsCount = \App\Models\Accreditation::count();
                        @endphp

                        <p class="lead mb-4">
                            {{ $missionEntry ? ($locale === 'am' ? $missionEntry->content_am : $missionEntry->content_en) : __("Our mission text not provided yet.") }}
                        </p>

                        <div class="d-flex gap-3 mb-4">
                            <div class="text-center flex-fill p-3 border rounded shadow-sm" style="background-color:white;">
                                <h3 class="text-primary">{{ $doctorsCount }}</h3>
                                <p class="m-0 fw-bold">{{ __('about.qualified_experts') }}</p>
                            </div>
                            <div class="text-center flex-fill p-3 border rounded shadow-sm" style="background-color:white;">
                                <h3 class="text-primary">{{ $accreditationsCount }}</h3>
                                <p class="m-0 fw-bold">{{ __('about.accreditations') }}</p>
                            </div>
                        </div>

                        <a href="{{ route('contacts.index') }}" class="btn btn-lg fw-bold" style="background-color:#3fbbc0; color:white;">
                            {{ __('about.make_appointment') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
</section>


<!-- ===================== Mission, Vision, Core Values ===================== -->
<section class="py-5" style="background-color:white;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold" style="color:#3fbbc0;">{{ __('about.our_philosophy') }}</h2>
                <p class="text-secondary lead">{{ __('about.philosophy_text') }}</p>
            </div>
        </div>
        <div class="row text-center gy-4">

            @php
                $types = ['mission', 'vision', 'core_values'];
            @endphp

            @foreach($types as $type)
                @php
    $entry = $aboutEntries->firstWhere('type', $type);
    $title = $locale === 'am' 
        ? ($entry->title_am ?? ucfirst(str_replace('_',' ', $type))) 
        : ($entry->title_en ?? ucfirst(str_replace('_',' ', $type)));
    $content = $entry ? ($locale === 'am' ? $entry->content_am : $entry->content_en) : 'Content not available';
@endphp

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100 hover-shadow"
                         style="transition: transform 0.3s; cursor:pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#modal-{{ $type }}">
                        
                        <h4 class="fw-bold" style="color:#3fbbc0;">{{ $title }}</h4>

                        @if($entry)
                            @if($type === 'core_values')
                                <ul class="list-unstyled">
                                    @foreach(array_slice(explode('|', $content), 0, 3) as $value)
                                        <li>• {{ $value }}</li>
                                    @endforeach
                                    <!-- @if(count(explode('|', $content)) > 3)
                                        <li class="text-primary">... {{ __('about.read_more') }}</li>
                                    @endif -->
                                </ul>
                            @else
                                <p>{{ \Illuminate\Support\Str::limit($content, 100, '...') }}</p>
                            @endif
                        @else
                            <p>{{ __('about.not_provided') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-{{ $type }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-start">
                                @if($type === 'core_values')
                                    <ul>
                                        @foreach(explode('|', $content) as $value)
                                            <li>• {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>{{ $content }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>





    





<!-- Leadership & Management Section -->
<section class="py-5 leadership-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold">
                {{ app()->getLocale() == 'am' ? 'ሊደርሺፕ እና አስተዳደር' : 'Leadership & Management' }}
            </h2>
            <p class="lead text-muted">
                {{ app()->getLocale() == 'am' 
                    ? 'የጤና አገልግሎት ባለሙያዎችና አስተዳደሪዎች ቡድናችንን ይግኙ' 
                    : 'Meet our dedicated team of healthcare professionals and administrators' }}
            </p>
        </div>

        <div class="row g-4">
            @foreach($managementTeam as $leader)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $leader->photo ? asset('storage/' . $leader->photo) : 'https://images.unsplash.com/photo-1576091160399-112ba8d25d15?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                         class="card-img-top" alt="{{ $leader->{'name_' . app()->getLocale()} }}">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $leader->{'name_' . app()->getLocale()} }}</h5>
                        <p class="text-muted mb-1">{{ $leader->{'department_' . app()->getLocale()} }}</p>
                        <p class="card-text flex-grow-1">
                            {{ Str::limit($leader->{'bio_' . app()->getLocale()}, 100) }}
                        </p>
                        <button type="button" class="btn btn-outline-primary mt-auto" data-bs-toggle="modal" data-bs-target="#leaderModal{{ $leader->id }}">
                            {{ app()->getLocale() == 'am' ? 'ሙሉ ባዮ ይመልከቱ' : 'View Full Bio' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Leader Modal -->
            <div class="modal fade" id="leaderModal{{ $leader->id }}" tabindex="-1" aria-labelledby="leaderModalLabel{{ $leader->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="leaderModalLabel{{ $leader->id }}">{{ $leader->{'name_' . app()->getLocale()} }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="max-height:70vh; overflow-y:auto;">
                            <div class="row">
                                <div class="col-md-4 text-center mb-3">
                                    <img src="{{ $leader->photo ? asset('storage/' . $leader->photo) : 'https://images.unsplash.com/photo-1576091160399-112ba8d25d15?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                                         class="img-fluid rounded" alt="{{ $leader->{'name_' . app()->getLocale()} }}">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>{{ app()->getLocale() == 'am' ? 'Position' : 'Position' }}:</strong> {{ $leader->{'position_' . app()->getLocale()} }}</p>
                                    <p><strong>{{ app()->getLocale() == 'am' ? 'Department' : 'Department' }}:</strong> {{ $leader->{'department_' . app()->getLocale()} }}</p>
                                    @if($leader->email)
                                    <p><i class="fas fa-envelope me-2"></i>{{ $leader->email }}</p>
                                    @endif
                                    @if($leader->phone)
                                    <p><i class="fas fa-phone me-2"></i>{{ $leader->phone }}</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h6>{{ app()->getLocale() == 'am' ? 'Biography' : 'Biography' }}</h6>
                                <p>{{ $leader->{'bio_' . app()->getLocale()} }}</p>
                            </div>
                            @if($leader->qualification_en || $leader->qualification_am || $leader->experience_years)
                            <div>
                                <h6>{{ app()->getLocale() == 'am' ? 'Qualifications & Experience' : 'Qualifications & Experience' }}</h6>
                                <p>
                                    @if($leader->{'qualification_' . app()->getLocale()})
                                        {{ $leader->{'qualification_' . app()->getLocale()} }}
                                    @endif
                                    @if($leader->experience_years)
                                        @if($leader->{'qualification_' . app()->getLocale()})
                                            <br>
                                        @endif
                                        {{ $leader->experience_years }} {{ app()->getLocale() == 'am' ? 'ዓመት ልምድ' : 'Years of Experience' }}
                                    @endif
                                </p>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<style>
.leadership-section {
    background: #f8fafc;
}

.leadership-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.leadership-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.leader-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.leader-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.leadership-card:hover .leader-image img {
    transform: scale(1.1);
}

.leader-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(26, 118, 210, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.leadership-card:hover .leader-overlay {
    opacity: 1;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    color: #1a76d2;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #1a76d2;
    color: white;
    transform: translateY(-3px);
}

.leader-info {
    padding: 25px;
}

.leader-name {
    font-weight: 700;
    color: #1a76d2;
    margin-bottom: 5px;
}

.leader-position {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.leader-department, .leader-qualification, .leader-experience {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.leader-bio {
    color: #555;
    margin-bottom: 15px;
    line-height: 1.6;
}

.org-chart {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.org-node {
    background: #1a76d2;
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin: 10px;
    display: inline-block;
}

.org-node.ceo {
    background: #0d47a1;
    padding: 25px 30px;
}

.org-node.department {
    background: #34a853;
}

.org-connector {
    height: 40px;
    width: 3px;
    background: #1a76d2;
    margin: 0 auto;
    position: relative;
}

.org-connector:after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: 10px solid #1a76d2;
}

.accreditation-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    height: 100%;
    transition: all 0.3s ease;
}

.accreditation-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.accreditation-icon {
    text-align: center;
    padding: 20px 0;
}

.section-title {
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 30px;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: #1a76d2;
}

@media (max-width: 768px) {
    .leader-image {
        height: 200px;
    }
    
    .org-node {
        padding: 15px;
        margin: 5px;
    }
}
</style>


















<!-- --------------------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------------------------------------------- -->
<!-- history section with full-height clickable video or image -->
@if($history)
<section class="py-5 position-relative" style="background: linear-gradient(to right, #ffffff, #e6f7f9);">
    <div class="container">
        <div class="row align-items-stretch">
            <!-- Left side: history text + button, vertically centered -->
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                
                <!-- Title wrapper with slight shift -->
                <div style="margin-left:120px;"> 
                    <h2 class="fw-bold mb-4" style="color:#3fbbc0; font-size:2.5rem;">
                        {{ $locale === 'am' ? $history->title_am : $history->title_en }}
                    </h2>
                </div>

                <p class="text-secondary fs-5 animate__animated animate__fadeIn" style="line-height:1.8;">
                    {{ $locale === 'am' ? $history->content_am : $history->content_en }}
                </p>

                <div class="mt-4" style="margin-left:120px;">
                   <a href="{{ route('front.history') }}" 
                      class="btn btn-lg" 
                      style="background-color:#3fbbc0; color:#fff; border-radius:50px; box-shadow: 0 5px 15px rgba(63,187,192,0.4); transition:all 0.3s;">
                        {{ app()->getLocale() === 'am' ? 'ሙሉ ታሪክ ይመልከቱ' : 'View full history >>' }}
                    </a>
                </div>

            </div>

<!-- Right side: full-height dynamic video or image -->
<div class="col-lg-6 d-flex align-items-stretch position-relative">
    @if($history->image)
        {{-- Background image --}}
        <img src="{{ asset('storage/' . $history->image) }}" 
             alt="History Image"
             style="width:100%; height:100%; object-fit:cover; border-radius:10px;" 
             class="shadow animate__animated animate__fadeInRight">

        @if($history->history_video)
            @php
                $videoUrl = $history->history_video;
                // convert to full YouTube watch link
                if (Str::contains($videoUrl, 'youtu.be')) {
                    $videoUrl = 'https://www.youtube.com/watch?v=' . Str::after($videoUrl, 'youtu.be/');
                } elseif (Str::contains($videoUrl, 'embed')) {
                    $videoUrl = str_replace('/embed/', '/watch?v=', $videoUrl);
                }
            @endphp

{{-- Play button overlay --}}
<a href="{{ $videoUrl }}" target="_blank" 
   style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); text-decoration:none;">
    {{-- Circle with triangle icon --}}
    <div style="width:80px; height:80px; border-radius:50%; background:rgba(0,0,0,0.6); display:flex; align-items:center; justify-content:center; cursor:pointer;">
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 100 100" fill="#fff">
            <polygon points="35,25 35,75 75,50" />
        </svg>
    </div>
</a>

        @endif

    @elseif($history->history_video)
        {{-- If no image, fallback to simple link with icon --}}
        @php
            $videoUrl = $history->history_video;
            if (Str::contains($videoUrl, 'youtu.be')) {
                $videoUrl = 'https://www.youtube.com/watch?v=' . Str::after($videoUrl, 'youtu.be/');
            } elseif (Str::contains($videoUrl, 'embed')) {
                $videoUrl = str_replace('/embed/', '/watch?v=', $videoUrl);
            }
        @endphp
        <a href="{{ $videoUrl }}" target="_blank" 
           class="d-flex align-items-center justify-content-center w-100 h-100 shadow rounded" 
           style="background-color:#000; text-decoration:none;">
            <div style="width:80px; height:80px; border-radius:50%; background:rgba(0,0,0,0.6); display:flex; align-items:center; justify-content:center; cursor:pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" viewBox="0 0 16 16">
                    <path d="M10.804 8 5.796 5.19v5.62L10.804 8z"/>
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4z"/>
                </svg>
            </div>
        </a>
    @else
        <div class="d-flex align-items-center justify-content-center w-100 h-100 shadow rounded"
             style="background-color:#e0f7fa;">
            <p class="text-secondary">No media uploaded</p>
        </div>
    @endif
</div>



        </div>
    </div>
</section>
@endif




<!-- ===================== Call To Action Section ===================== -->
<section class="py-5 text-center" style="background-color:#3fbbc0; color:white;">
    <div class="container">
        <h2 class="display-5 fw-bold mb-3">{{ __('about.cta_title') }}</h2>
        <p class="lead mb-4">{{ __('about.cta_text') }}</p>        
        <a href="{{ route('contacts.index') }}" class="btn btn-light btn-lg fw-bold">{{ __('about.make_appointment') }}</a>
    </div>
</section>

<!-- ===================== Hover Animation ===================== -->
<style>
.hover-shadow:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}
.about-row {
    display: flex;
    align-items: stretch;
}
.about-img-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    border-radius: 12px;
}
.about-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.about-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(63, 187, 192, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-align: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.5s ease;
}
.about-img-wrapper:hover img {
    transform: scale(1.1);
}
.about-img-wrapper:hover .about-overlay {
    opacity: 1;
}
</style>

@endsection

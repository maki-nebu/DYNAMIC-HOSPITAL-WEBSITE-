@extends('front.layouts.app_white')

@section('title', 'Hospital History & Milestones')

@push('styles')
<style>
    :root {
        --primary: #1a76d2;
        --primary-light: #4a98e6;
        --secondary: #2bb673;
        --dark: #2c3e50;
        --light: #f8f9fa;
        --gray: #6c757d;
        --white: #ffffff;
        --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: var(--dark);
        line-height: 1.6;
        background-color: var(--light);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Hero Section */
    .hero {
        background: url('https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1800&q=80') no-repeat center center/cover;
        height: 450px;
        display: flex;
        align-items: center;
        position: relative;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .hero-content {
        position: relative;
        color: var(--white);
        max-width: 700px;
        padding: 0 20px;
    }

    .hero-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .hero-content p {
        font-size: 1.2rem;
        margin-bottom: 30px;
    }

    /* Section Styles */
    section {
        padding: 80px 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--primary);
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: var(--secondary);
    }

    /* History Section */
    .history-content {
        background: var(--white);
        border-radius: 10px;
        padding: 40px;
        box-shadow: var(--shadow);
        margin-bottom: 40px;
    }

    .history-content p {
        margin-bottom: 20px;
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* Milestones */
    .timeline {
        position: relative;
        max-width: 1000px;
        margin: 0 auto;
    }

    .timeline::after {
        content: '';
        position: absolute;
        width: 6px;
        background-color: var(--primary);
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
        border-radius: 10px;
    }

    .milestone {
        padding: 10px 40px;
        position: relative;
        width: 50%;
        animation: fadeIn 1s;
    }

    .milestone:nth-child(odd) {
        left: 0;
    }

    .milestone:nth-child(even) {
        left: 50%;
    }

    .milestone-content {
        padding: 20px;
        background-color: var(--white);
        border-radius: 10px;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        z-index: 3;
    }

    .milestone-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .milestone-date {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 5px;
        display: block;
    }

    .milestone-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        margin-bottom: 5px;
        color: var(--dark);
    }

    .milestone-desc {
        color: var(--gray);
        font-size: 1rem;
    }

/* Timeline Images - Matching Milestone Cards */
.milestone-image-wrapper {
    position: absolute;
    top: 20px;
    width: calc(100% - 40px);
    max-width: 400px;
    z-index: 2;
}

.milestone:nth-child(odd) .milestone-image-wrapper {
    right: -420px;
}

.milestone:nth-child(even) .milestone-image-wrapper {
    left: -420px;
}

.milestone-line-image {
    width: 100%;
    padding-bottom: 43.25%; /* 16:9 aspect ratio (less tall than before) */
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.milestone-line-image img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    top: 0;
    left: 0;
}

/* Responsive adjustments */
@media screen and (max-width: 1200px) {
    .milestone:nth-child(odd) .milestone-image-wrapper {
        right: -380px;
    }
    
    .milestone:nth-child(even) .milestone-image-wrapper {
        left: -380px;
    }
    
    .milestone-image-wrapper {
        max-width: 350px;
    }
}

@media screen and (max-width: 1000px) {
    .milestone:nth-child(odd) .milestone-image-wrapper {
        right: -340px;
    }
    
    .milestone:nth-child(even) .milestone-image-wrapper {
        left: -340px;
    }
    
    .milestone-image-wrapper {
        max-width: 300px;
    }
    
    .milestone-line-image {
        padding-bottom: 60%; /* Slightly taller on medium screens */
    }
}

@media screen and (max-width: 900px) {
    .milestone:nth-child(odd) .milestone-image-wrapper {
        right: -300px;
    }
    
    .milestone:nth-child(even) .milestone-image-wrapper {
        left: -300px;
    }
    
    .milestone-image-wrapper {
        max-width: 250px;
    }
    
    .milestone-line-image {
        padding-bottom: 65%; /* Taller on smaller screens */
    }
}

@media screen and (max-width: 768px) {
    .milestone-image-wrapper {
        position: relative;
        left: 0 !important;
        right: 0 !important;
        margin: 20px auto;
        top: 0;
        width: 100%;
        max-width: 400px;
    }
    
    .milestone-line-image {
        padding-bottom: 35%; /* Less tall on mobile */
    }
}

    /* Responsive */
    @media screen and (max-width: 1000px) {
        .milestone:nth-child(odd) .milestone-image-wrapper {
            right: -150px;
        }
        
        .milestone:nth-child(even) .milestone-image-wrapper {
            left: -150px;
        }
    }

    @media screen and (max-width: 900px) {
        .milestone:nth-child(odd) .milestone-image-wrapper {
            right: -120px;
        }
        
        .milestone:nth-child(even) .milestone-image-wrapper {
            left: -120px;
        }
        
        .milestone-line-image {
            width: 80px;
            height: 80px;
        }
    }

    @media screen and (max-width: 768px) {
        .timeline::after {
            left: 31px;
        }

        .milestone {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        .milestone:nth-child(even) {
            left: 0;
        }

        .milestone:nth-child(odd)::after,
        .milestone:nth-child(even)::after {
            left: 18px;
        }
        
        .milestone-image-wrapper {
            position: relative;
            left: 0 !important;
            right: 0 !important;
            margin: 15px auto;
            top: 0;
        }
        
        .milestone-line-image {
            width: 100px;
            height: 100px;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
        animation: fadeIn 1s ease-in;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero">
        <div class="container hero-content">
            <h2>{{ app()->getLocale() === 'am' ? 'የእኛ ታሪክ እና አስፋሪ ጊዜያዊ ነጥቦች' : 'Our History & Milestones' }}</h2>
            <p>{{ app()->getLocale() === 'am' 
                ? 'ከትንሹ መነሻ እስከ በጤና ዘርፍ ውስጥ የተደረገ እኩልነት ማዕከል ድረስ የሆነ የሆሳል ጉዞ ይጎብኙ።' 
                : 'Explore the journey of our hospital, from humble beginnings to a center of excellence in healthcare.' }}</p>
        </div>
    </div>

    <!-- History Section -->
    <section id="history">
        <div class="container">
            <div class="section-title">
                <h2>{{ app()->getLocale() === 'am' ? ($history->title_am ?? 'የእኛ ታሪክ') : ($history->title_en ?? 'Our History') }}</h2>
            </div>
            <div class="history-content">
                @if($history)
                    <p>{{ app()->getLocale() === 'am' ? $history->content_am : $history->content_en }}</p>
                @else
                    <p>{{ app()->getLocale() === 'am' ? 'እስካሁን የታሪክ ይዘት አልተገኘም።' : 'No history content available yet.' }}</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Milestones Section -->
    @php
        $milestones = \App\Models\About::where('type', 'milestone')->get();
    @endphp

    <section id="milestones">
        <div class="container">
            <div class="section-title">
                <h2>{{ app()->getLocale() === 'am' ? 'አስፋሪ ጊዜያዊ ነጥቦች' : 'Our Milestones' }}</h2>
            </div>

            <div class="timeline">
                @foreach($milestones as $index => $milestone)
                    <div class="milestone fade-in">
                        
                        {{-- Card Content --}}
                        <div class="milestone-content">
                            <span class="milestone-date">{{ $milestone->year }}</span>
                            <h3 class="milestone-title">{{ app()->getLocale() === 'am' ? $milestone->title_am : $milestone->title_en }}</h3>
                            <p class="milestone-desc">{{ app()->getLocale() === 'am' ? $milestone->content_am : $milestone->content_en }}</p>
                        </div>

                        {{-- Image across the timeline line, alternating sides --}}
@if($milestone->image)
    <div class="milestone-image-wrapper">
        <div class="milestone-line-image">
            <img src="{{ asset('storage/' . $milestone->image) }}" 
                 alt="Milestone Image">
        </div>
    </div>
@endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        const milestones = document.querySelectorAll('.milestone');

        function checkScroll() {
            milestones.forEach(milestone => {
                const milestoneTop = milestone.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (milestoneTop < windowHeight * 0.9) {
                    milestone.classList.add('fade-in');
                }
            });
        }

        window.addEventListener('scroll', checkScroll);
        window.addEventListener('load', checkScroll);
    </script>
@endsection
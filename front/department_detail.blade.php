@extends('front.layouts.app_white')

@section('content')
   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $department->department_name }} - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a76d2;
            --secondary: #34a853;
            --accent: #f44336;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            line-height: 1.6;
            background: #f9fbfd;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ $department->department_photo ? asset('storage/' . $department->department_photo) : 'https://images.unsplash.com/photo-1587351021759-3e566b3db4f7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80' }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            text-align: center;
            position: relative;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .department-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: white;
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
            background: var(--primary);
        }
        
        /* Services Grid Layout */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .service-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .service-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .service-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--dark);
            flex-grow: 1;
        }
        
        .read-more {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        
        .read-more i {
            margin-left: 5px;
            transition: transform 0.3s;
        }
        
        .service-item:hover .read-more i {
            transform: translateX(3px);
        }
        
        /* Modal Styling */
        .modal-service-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        /* Other existing styles */
        .director-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .director-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .director-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary);
            margin: 0 auto;
        }
        
        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
        }
        
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        
        .operating-hours {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .hour-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .hour-row:last-child {
            border-bottom: none;
        }
        
        .contact-box {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .contact-icon {
            font-size: 1.5rem;
            color: var(--primary);
            margin-right: 15px;
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
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .department-icon {
                font-size: 3rem;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<section class="hero-section">
    <div class="container hero-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($department->icon)
                    <div class="department-icon">
                        <i class="{{ $department->icon }}"></i>
                    </div>
                @endif
                <h1 class="display-4 fw-bold">
                    {{ app()->getLocale() == 'am' ? $department->department_name_am : $department->department_name }}
                </h1>
                <p class="lead">
                    {{ app()->getLocale() == 'am' ? $department->description_am : $department->description }}
                </p>
                <a href="{{ route('front.departments') }}" class="back-button">
                    <i class="fas fa-arrow-left me-2"></i> 
                    {{ app()->getLocale() == 'am' ? 'ተመለስ' : 'Back to Departments' }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Department Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Services Section -->
            <div class="col-lg-8">
                <div class="mb-5">
                    <h2 class="section-title">
                        {{ app()->getLocale() == 'am' ? 'አገልግሎቶች እና ሂደቶች' : 'Services & Procedures' }}
                    </h2>
                    
                    @php
                        $departmentServices = $services->where('directorate_id', $department->id);
                    @endphp
                    
                    @if($departmentServices->count() > 0)
                        <div class="services-grid">
                            @foreach($departmentServices as $service)
<a href="{{ route('services.show', $service->id) }}" class="service-item text-decoration-none">
    @if($service->icon)
        <div class="service-icon">
            <i class="{{ $service->icon }}"></i>
        </div>
    @endif
    <h4 class="service-title">
        {{ app()->getLocale() == 'am' ? $service->name_am : $service->name_en }}
    </h4>
    <div class="read-more">
        {{ app()->getLocale() == 'am' ? 'ይበልጥ ያንብቡ' : 'Read more' }} <i class="fas fa-arrow-right"></i>
    </div>
</a>

<!-- Service Modal -->
<div class="modal fade" id="serviceModal{{ $service->id }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $service->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: white; border-bottom: 1px solid #eaeaea;">
                <div class="d-flex align-items-center">
                    @if($service->icon)
                        <div class="me-3" style="font-size: 2rem; color: #1a76d2;">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                    @endif
                    <h5 class="modal-title" id="serviceModalLabel{{ $service->id }}" style="font-weight: 700; color: #1a76d2;">
                        {{ app()->getLocale() == 'am' ? $service->name_am : $service->name_en }}
                    </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background: #fafbfc;">
                @if($service->image)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $service->image) }}" 
                             alt="{{ app()->getLocale() == 'am' ? $service->name_am : $service->name_en }}" 
                             class="img-fluid rounded" style="max-height: 200px; width: auto; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                    </div>
                @endif
                
                <div class="service-description" style="font-size: 1.1rem; line-height: 1.7; color: #444;">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-primary mb-3"><i class="fas fa-info-circle me-2"></i> 
                                {{ app()->getLocale() == 'am' ? 'የአገልግሎት ዝርዝር' : 'Service Details' }}
                            </h6>
                            <p class="card-text">
                                {{ app()->getLocale() == 'am' ? ($service->description_am ?? 'ለዚህ አገልግሎት ዝርዝር መግለጫ አልተገኘም።') : ($service->description_en ?? 'No detailed description available for this service.') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-success mb-3"><i class="fas fa-clock me-2"></i> 
                                        {{ app()->getLocale() == 'am' ? 'ቆይታ' : 'Duration' }}
                                    </h6>
                                    <p class="card-text">
                                        {{ app()->getLocale() == 'am' ? 'ብዙውን ጊዜ 30-60 ደቂቃ' : 'Typically 30-60 minutes' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="card-title text-info mb-3"><i class="fas fa-user-md me-2"></i> 
                                        {{ app()->getLocale() == 'am' ? 'ባለሙያ' : 'Specialist' }}
                                    </h6>
                                    <p class="card-text">
                                        {{ app()->getLocale() == 'am' ? 'የተማሩ ባለሙያዎች' : 'Board-certified professionals' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: white; border-top: 1px solid #eaeaea;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 30px; padding: 8px 20px;">
                    {{ app()->getLocale() == 'am' ? 'ዝጋ' : 'Close' }}
                </button>
                <button type="button" class="btn btn-primary" style="border-radius: 30px; padding: 8px 25px;">
                    <i class="fas fa-phone-alt me-2"></i> 
                    {{ app()->getLocale() == 'am' ? 'ያግኙን' : 'Contact Us' }}
                </button>
            </div>
        </div>
    </div>
</div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> 
                            {{ app()->getLocale() == 'am' ? 'የአገልግሎት መረጃ በቅርቡ ይታወቃል።' : 'Service information will be updated soon.' }}
                        </div>
                    @endif
                </div>
                    
<!-- Equipment & Facilities -->
<div class="mb-5">
    <h2 class="section-title">
        {{ app()->getLocale() == 'am' ? 'መሳሪያዎች እና ማቅረቢያዎች' : 'Equipment & Facilities' }}
    </h2>
    <div class="row">
        @php
            $half = ceil($facilities->count() / 2);
            $firstHalf = $facilities->slice(0, $half);
            $secondHalf = $facilities->slice($half);
        @endphp

        <div class="col-md-6">
            <ul class="list-group">
                @foreach($firstHalf as $facility)
                    <li class="list-group-item border-0">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        {{ app()->getLocale() == 'am' ? $facility->name_am : $facility->name_en }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <ul class="list-group">
                @foreach($secondHalf as $facility)
                    <li class="list-group-item border-0">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        {{ app()->getLocale() == 'am' ? $facility->name_am : $facility->name_en }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <p class="mt-3 text-muted">
        <em>{{ app()->getLocale() == 'am' ? 'ለዝርዝር የመሳሪያ ዝርዝር እባክዎ በቀጥታ ክፍሉን ያግኙ።' : 'Note: For a detailed list of equipment, please contact the department directly.' }}</em>
    </p>
</div>

<!-- Gallery Section -->
<div class="mb-5">
    <h2 class="section-title">
        {{ app()->getLocale() == 'am' ? 'የክፍሉ ጋለሪ' : 'Department Gallery' }}
    </h2>
    <div class="row">
        @if($galleries->count() > 0)
            @foreach($galleries as $gallery)
                <div class="col-md-4 mb-4">
                    <div class="gallery-item shadow-sm">
                        <img src="{{ asset('storage/galleries/' . $gallery->image) }}" 
                             alt="{{ app()->getLocale() == 'am' ? $gallery->name_am : $gallery->name }}">
                        <div class="mt-2 text-center fw-semibold">
                            {{ app()->getLocale() == 'am' ? $gallery->name_am : $gallery->name }}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">
                {{ app()->getLocale() == 'am' ? 'ምንም የጋለሪ ምስል አልተገኘም።' : 'No gallery images available for this department.' }}
            </p>
        @endif
    </div>
</div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Leadership -->
                <div class="mb-5">
                    <h2 class="section-title">
                        {{ app()->getLocale() == 'am' ? 'የክፍሉ መሪነት' : 'Department Leadership' }}
                    </h2>
                    <div class="director-card text-center p-4">
                        @if($department->director_photo)
                            <img src="{{ asset('storage/' . $department->director_photo) }}" alt="{{ $department->director_name }}" class="director-img mb-3">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Director" class="director-img mb-3">
                        @endif
                        <h4>{{ $department->director_name ?? (app()->getLocale() == 'am' ? 'የዳይሬክተር ስም' : 'Director Name') }}</h4>
                        <p class="text-muted">{{ app()->getLocale() == 'am' ? 'የክፍሉ ዳይሬክተር' : 'Department Director' }}</p>
                    </div>
                    
                    @if($department->vice_director)
                    <div class="director-card text-center p-4 mt-4">
                        @if($department->vice_director_photo)
                            <img src="{{ asset('storage/' . $department->vice_director_photo) }}" alt="{{ $department->vice_director }}" class="director-img mb-3">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Vice Director" class="director-img mb-3">
                        @endif
                        <h4>{{ $department->vice_director }}</h4>
                        <p class="text-muted">{{ app()->getLocale() == 'am' ? 'ንዑስ ዳይሬክተር' : 'Vice Director' }}</p>
                    </div>
                    @endif
                </div>
                
<!-- Operating Hours -->
<div class="mb-5">
    <h2 class="section-title">
        {{ app()->getLocale() == 'am' ? 'የመስራት ሰዓት' : 'Operating Hours' }}
    </h2>
    <div class="operating-hours">

        @if(!empty($setting->working_hours))
            @foreach(explode("\n", $setting->working_hours) as $line)
                @php
                    $parts = preg_split('/:\s+/', $line, 2); // split only at the first ": "
                @endphp
                <div class="hour-row">
                    <span>{{ $parts[0] ?? '' }}</span>
                    <span>{{ $parts[1] ?? '' }}</span>
                </div>
            @endforeach
        @else
            <!-- Fallback if admin hasn’t set working_hours -->
            <div class="hour-row">
                <span>{{ app()->getLocale() == 'am' ? 'ሰኞ - አርብ' : 'Monday - Friday' }}</span>
                <span>8:00 AM - 6:00 PM</span>
            </div>
            <div class="hour-row">
                <span>{{ app()->getLocale() == 'am' ? 'ቅዳሜ' : 'Saturday' }}</span>
                <span>9:00 AM - 2:00 PM</span>
            </div>
            <div class="hour-row">
                <span>{{ app()->getLocale() == 'am' ? 'እሑድ' : 'Sunday' }}</span>
                <span>{{ app()->getLocale() == 'am' ? 'ዝግ' : 'Closed' }}</span>
            </div>
        @endif

        <div class="hour-row fw-bold">
            <span>{{ app()->getLocale() == 'am' ? 'የአደጋ አገልግሎት' : 'Emergency Services' }}</span>
            <span>24/7</span>
        </div>

        <p class="mt-3 small text-muted">
            * {{ app()->getLocale() == 'am' ? 'በበዓላት ወቅት ሰዓቶች ሊለያዩ ይችላሉ' : 'Hours may vary during holidays' }}
        </p>
    </div>
</div>


<!-- Modern Fancy Contact Section -->
<div class="mb-5">
    <h2 class="section-title text-primary mb-4">
        {{ app()->getLocale() == 'am' ? 'መገናኛ መረጃ' : 'Contact Information' }}
    </h2>
    <div class="row g-4">
        <!-- Phone -->
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center p-4 rounded-4 shadow-sm contact-item h-100" style="background: #f0f8ff; transition: transform 0.3s;">
                <div class="icon-circle bg-primary text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ app()->getLocale() == 'am' ? 'ስልክ' : 'Phone' }}</h6>
                    <a href="tel:{{ $settings->phone }}" class="text-decoration-none fw-bold">{{ $settings->phone }}</a>
                </div>
            </div>
        </div>

        <!-- Email -->
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center p-4 rounded-4 shadow-sm contact-item h-100" style="background: #f0fff0; transition: transform 0.3s;">
                <div class="icon-circle bg-success text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ app()->getLocale() == 'am' ? 'ኢሜይል' : 'Email' }}</h6>
                    <a href="mailto:{{ $settings->emailInfo }}" class="text-decoration-none fw-bold">{{ $settings->emailInfo }}</a>
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center p-4 rounded-4 shadow-sm contact-item h-100" style="background: #fffaf0; transition: transform 0.3s;">
                <div class="icon-circle bg-warning text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ app()->getLocale() == 'am' ? 'አድራሻ' : 'Address' }}</h6>
                    <p class="mb-0 fw-bold">
                        {{ app()->getLocale() == 'am' ? ($settings->address_am ?? $settings->address) : $settings->address }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Working Hours -->
        <div class="col-12 col-md-6">
            <div class="d-flex align-items-center p-4 rounded-4 shadow-sm contact-item h-100" style="background: #f0f5ff; transition: transform 0.3s;">
                <div class="icon-circle bg-info text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ app()->getLocale() == 'am' ? 'የስራ ሰዓት' : 'Working Hours' }}</h6>
                    <p class="mb-0 fw-bold">
                        {{ $settings->no_hours ?? (app()->getLocale() == 'am' ? 'አልተገለጸም' : 'Not specified') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Styling -->
<style>
    .icon-circle {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        font-size: 1.2rem;
    }
    .contact-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }
    .contact-item h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
    }
    .contact-item a {
        color: inherit;
    }
</style>

                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


@endsection

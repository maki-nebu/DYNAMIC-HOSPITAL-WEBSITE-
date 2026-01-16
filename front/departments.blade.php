



@extends('front.layouts.app_white')

@section('content')
  

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Departments - {{ config('app.name') }}</title>
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
            background: url('https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 180px 0;
            text-align: center;
            position: relative;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-section h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        }
        
        .hero-section p {
            font-size: 1.5rem;
            max-width: 700px;
            margin: 0 auto;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
        }
        
        /* Modern List Design */
        .department-list {
            padding: 80px 0;
        }
        
        .department-item {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .department-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .department-image {
            flex: 0 0 300px;
            height: 250px;
            overflow: hidden;
        }
        
        .department-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .department-item:hover .department-image img {
            transform: scale(1.05);
        }
        
        .department-content {
            flex: 1;
            padding: 30px;
        }
        
        .department-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .department-services {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 15px 0;
        }
        
        .service-tag {
            background: #f0f7ff;
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .view-details-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .view-details-btn:hover {
            background: #0d47a1;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 71, 161, 0.3);
        }
        
        /* Alternate layout for even items */
        .department-item:nth-child(even) {
            flex-direction: row-reverse;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .department-item,
            .department-item:nth-child(even) {
                flex-direction: column;
            }
            
            .department-image {
                flex: 0 0 200px;
                width: 100%;
            }
            
            .hero-section h1 {
                font-size: 2.8rem;
            }
        }
    </style>
</head>
<body>

<!-- Hero Section with fully visible background -->
<section class="hero-section">
    <div class="hero-content">
        <div class="container">
            <h1 class="display-3 fw-bold">
                {{ App::getLocale() == 'am' ? 'የሕክምና መርሀ ግብሮቻችን' : 'Our Medical Departments' }}
            </h1>
            <p class="lead">
                {{ App::getLocale() == 'am' ? 'ለእያንዳንዱ ፍላጎት የተለያዩ እንክብካቤዎች በርቱ እና በሙያ ተዘጋጅተዋል' : 'Specialized care for every need, delivered with compassion and expertise' }}
            </p>
        </div>
    </div>
</section>

<!-- Departments Listing -->
<section class="department-list">
    <div class="container">
        @foreach($departments as $department)
            @if($department->is_active)
                <div class="department-item">
                    
                    {{-- Department Image --}}
                    <div class="department-image">
                        @if($department->department_photo)
                            <img src="{{ asset('storage/' . $department->department_photo) }}" alt="{{ App::getLocale() == 'am' ? $department->department_name_am : $department->department_name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1587351021759-3e566b3db4f7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="{{ App::getLocale() == 'am' ? $department->department_name_am : $department->department_name }}">
                        @endif
                    </div>
                    
                    <div class="department-content">
                        
                        {{-- Icon --}}
                        @if($department->icon)
                            <div class="department-icon">
                                <i class="{{ $department->icon }}"></i>
                            </div>
                        @endif
                        
                      {{-- Name + Description --}}
<h3>
    {{ App::getLocale() == 'am' 
        ? 'የ' . $department->department_name_am . ' መርሀ ግብር' 
        : 'Department of ' . $department->department_name }}
</h3>
<p>
    {{ App::getLocale() == 'am' 
        ? Str::limit($department->description_am, 150) 
        : Str::limit($department->description, 150) }}
</p>

                        
                        {{-- Services Preview --}}
                        <div class="department-services">
                            @php
                                $departmentServices = $services->where('directorate_id', $department->id)->take(3);
                                $totalServices = $services->where('directorate_id', $department->id)->count();
                            @endphp
                            
                            @if($departmentServices->count() > 0)
                                @foreach($departmentServices as $service)
                                    <span class="service-tag">
                                        {{ App::getLocale() == 'am' ? $service->name_am : $service->name_en }}
                                    </span>
                                @endforeach
                                @if($totalServices > 3)
                                    <span class="service-tag">+{{ $totalServices - 3 }} more</span>
                                @endif
                            @else
                                <span class="service-tag">{{ App::getLocale() == 'am' ? 'የአጠቃላይ ምክንያት' : 'General Consultation' }}</span>
                                <span class="service-tag">{{ App::getLocale() == 'am' ? 'የምርመራ አገልግሎቶች' : 'Diagnostic Services' }}</span>
                                <span class="service-tag">{{ App::getLocale() == 'am' ? 'የሕክምና ዕቅዶች' : 'Treatment Plans' }}</span>
                            @endif
                        </div>
                        
                        {{-- Button --}}
                        @if($department->slug && $department->slug !== 'general')
                            <a href="{{ route('department.detail', ['slug' => $department->slug]) }}" class="view-details-btn">
                                {{ App::getLocale() == 'am' ? 'የመርሀ ግብር ተመልከት' : 'View Department' }}
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('front.departments') }}" class="view-details-btn">
                                {{ App::getLocale() == 'am' ? 'ሁሉንም መርሀ ግብሮች ያሳዩ' : 'Explore All Departments' }}
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection

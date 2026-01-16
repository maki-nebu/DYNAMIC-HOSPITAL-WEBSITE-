<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $setting->siteTitle ?? 'Hospital website' }}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="user/assets/img/favicon.png" rel="icon">
  <link href="user/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="user/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="user/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="user/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="user/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="user/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="user/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="user/assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page"
      style="font-size: {{ $visibility->font_size ?? '16px' }}; 
             @if($visibility->high_contrast) background-color: #000; color: #fff; @endif">

<header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
        <div class="container d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center">
            
            <!-- Working Hours -->
            <div class="d-flex align-items-center mb-1 mb-md-0">
                <i class="bi bi-clock me-2"></i>
                <span>
                    {!! nl2br(e($setting->working_hours ?? "Monday - Saturday\n8:00 AM - 10:00 PM")) !!}
                </span>
            </div>

            <!-- Phone -->
            <div class="d-flex align-items-center">
                <i class="bi bi-phone me-2"></i>
                <span>Call us now: {{ $setting->phone ?? '+251 79753322' }}</span>
            </div>

        </div>
    </div>
</header>




<header>
    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-end">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                @if(!empty($setting->logo_white))
                    <img src="{{ asset('uploads/Setting/' . $setting->logo_white) }}" alt="Logo" style="max-height: 50px;" class="me-2">
                @endif
                <h1 class="sitename">{{ $setting->siteTitle ?? 'Hospital' }}</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">{{ app()->getLocale() == 'am' ? 'መነሻ' : 'Home' }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about.page') }}">{{ app()->getLocale() == 'am' ? 'ስለ እኛ' : 'About' }}</a></li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            {{ app()->getLocale() == 'am' ? 'አገልግሎቶች' : 'Services' }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('services.frontend') }}">{{ app()->getLocale() == 'am' ? 'አገልግሎቶች' : 'Services' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.departments') }}">{{ app()->getLocale() == 'am' ? 'የሕክምና ክፍሎች' : 'Departments' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.facilities') }}">{{ app()->getLocale() == 'am' ? 'ተቋማት' : 'Facilities' }}</a></li>
                        </ul>
                    </li>

                    <li><a class="nav-link" href="{{ route('doctors.all') }}">{{ app()->getLocale() == 'am' ? 'ዶክተሮች' : 'Doctors' }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contacts.index') }}">{{ app()->getLocale() == 'am' ? 'አግኙን' : 'Contact' }}</a></li>

                    <li class="dropdown">
                        <a href="#"><span>{{ app()->getLocale() == 'am' ? 'ሌሎች' : 'More' }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a class="dropdown-item" href="{{ route('healthinfo.index') }}">{{ app()->getLocale() == 'am' ? 'የጤና መረጃ' : 'Health Information' }}</a></li>
                            <li><a class="nav-link" href="{{ route('news') }}">{{ app()->getLocale() == 'am' ? 'ዜና & ጽሑፎች' : 'News & Articles' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('accreditations.index') }}">{{ app()->getLocale() == 'am' ? 'ማረጋገጫዎች & ሽልማቶች' : 'Accreditations & Awards' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('faq.page') }}">{{ app()->getLocale() == 'am' ? 'የጤና መረጃ' : 'Frequently Asked Questions' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.gallery') }}">{{ app()->getLocale() == 'am' ? 'ጋለሪዎች' : 'Galleries' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('appointment.page') }}">{{ app()->getLocale() == 'am' ? 'ቀጠሮዎች' : 'Appointment' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('complaint.create') }}">{{ app()->getLocale() == 'am' ? 'ቅሬታዎች' : 'Complaints' }}</a></li>
                        </ul>
                    </li>

                    <!-- Language Switcher -->
                    @php
                        $queryParams = request()->query();
                    @endphp
                    <div class="d-flex ms-4">
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge($queryParams, ['lang' => 'en'])) }}"
                           class="btn btn-sm me-2 {{ app()->getLocale() == 'en' ? 'btn-light' : 'btn-outline-light' }}">English</a>
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge($queryParams, ['lang' => 'am'])) }}"
                           class="btn btn-sm {{ app()->getLocale() == 'am' ? 'btn-light' : 'btn-outline-light' }}">Amharic</a>
                    </div>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>

<main class="main">

    @if($visibility->home_hero) @include('front.home.hero') @endif
    @if($visibility->home_featured_services) @include('front.home.featured_services') @endif
    @if($visibility->home_cta) @include('front.home.cta') @endif
    @if($visibility->home_about) @include('front.home.about') @endif
    @if($visibility->home_stats) @include('front.home.stats') @endif
    @if($visibility->home_services) @include('front.home.services') @endif
    @if($visibility->home_departments) @include('front.home.departments') @endif
    @if($visibility->home_doctors) @include('front.home.doctors') @endif
     @if($visibility->home_departments) @include('front.home.certificates') @endif
    @if($visibility->home_departments) @include('front.home.blogs') @endif
    @if($visibility->home_testimony) @include('front.home.testimonials') @endif
    @if($visibility->home_gallery) @include('front.home.gallery') @endif
    @if($visibility->home_partnerships) @include('front.home.partnerships') @endif


</main>

@include('front.layouts.footer')

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="user/assets/vendor/php-email-form/validate.js"></script>
<script src="user/assets/vendor/aos/aos.js"></script>
<script src="user/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="user/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="user/assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="user/assets/js/main.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68cc4ce8780fd619258a9830/1j5f0orpv';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html>

<header id="header" class="header sticky-top">

    {{-- 🔹 Top Bar --}}
    <div class="topbar d-flex align-items-center" style="background-color:#3fbbc0;">
        <div class="container d-flex justify-content-center justify-content-md-between text-white small py-1">
            <div class="d-none d-md-flex align-items-center">
                <i class="bi bi-clock me-2"></i>
                @php
                    $setting = \App\Models\Setting::first();
                @endphp
                {{ $setting->working_hours ?? 'Monday - Saturday, 8AM to 10PM' }}
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-phone me-2"></i> {{ $setting->phone ?? '+1 5589 55488 55' }}
            </div>
        </div>
    </div>

    {{-- 🔹 Navbar --}}
    <div class="branding bg-white shadow-sm">
        <div class="container d-flex align-items-center justify-content-between py-1">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="logo d-flex align-items-center text-decoration-none">
                @if(!empty($setting->logo_white))
                    <img src="{{ asset('uploads/Setting/' . $setting->logo_white) }}" alt="Logo" style="max-height:50px;" class="me-2">
                @endif
                <h1 class="sitename mb-0 fw-bold" style="color:#3fbbc0;">{{ $setting->siteTitle ?? 'Hospital' }}</h1>
            </a>

            {{-- Navigation --}}
            <nav id="navmenu" class="navmenu">
                <ul class="d-flex align-items-center mb-0">
                    <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                        {{ app()->getLocale() == 'am' ? 'መነሻ' : 'Home' }}
                    </a></li>

                    <li><a href="{{ route('about.page') }}">
                        {{ app()->getLocale() == 'am' ? 'ስለ እኛ' : 'About' }}
                    </a></li>

                    {{-- Dropdown: Services --}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{ app()->getLocale() == 'am' ? 'አገልግሎቶች' : 'Services' }}
                        </a>
                        <ul class="dropdown-menu shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('services.frontend') }}">{{ app()->getLocale() == 'am' ? 'አገልግሎቶች' : 'Services' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.departments') }}">{{ app()->getLocale() == 'am' ? 'የሕክምና ክፍሎች' : 'Departments' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.facilities') }}">{{ app()->getLocale() == 'am' ? 'ተቋማት' : 'Facilities' }}</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('doctors.all') }}">{{ app()->getLocale() == 'am' ? 'ዶክተሮች' : 'Doctors' }}</a></li>
                    <li><a href="{{ route('contacts.index') }}">{{ app()->getLocale() == 'am' ? 'አግኙን' : 'Contact' }}</a></li>

                    {{-- Dropdown: More --}}
                    <li class="dropdown">
                        <a href="#"><span>{{ app()->getLocale() == 'am' ? 'ሌሎች' : 'More' }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul class="dropdown-menu shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('healthinfo.index') }}">{{ app()->getLocale() == 'am' ? 'የጤና መረጃ' : 'Health Information' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('news') }}">{{ app()->getLocale() == 'am' ? 'ዜና & ጽሑፎች' : 'News & Articles' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('accreditations.index') }}">{{ app()->getLocale() == 'am' ? 'ማረጋገጫዎች & ሽልማቶች' : 'Accreditations & Awards' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('faq.page') }}">{{ app()->getLocale() == 'am' ? 'በተደጋጋሚ የሚጠየቁ ጥያቄዎች' : 'Frequently Asked Questions' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.gallery') }}">{{ app()->getLocale() == 'am' ? 'ጋለሪዎች' : 'Galleries' }}</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('appointment.page') }}">{{ app()->getLocale() == 'am' ? 'ቀጠሮዎች' : 'Appointment' }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('complaint.create') }}">{{ app()->getLocale() == 'am' ? 'ቅሬታዎች' : 'Complaints' }}</a></li>
                        </ul>
                    </li>

                    {{-- Language Switcher --}}
                    @php $queryParams = request()->query(); @endphp
                    <li class="ms-3 d-flex align-items-center">
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge($queryParams, ['lang' => 'en'])) }}"
                           class="btn btn-sm me-2 {{ app()->getLocale() == 'en' ? 'btn-outline-primary' : 'btn-light text-dark' }}">
                           English
                        </a>
                        <a href="{{ url()->current() . '?' . http_build_query(array_merge($queryParams, ['lang' => 'am'])) }}"
                           class="btn btn-sm {{ app()->getLocale() == 'am' ? 'btn-outline-primary' : 'btn-light text-dark' }}">
                           Amharic
                        </a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list text-dark"></i>
            </nav>
        </div>
    </div>
</header>

{{-- 🔹 Inline Styles --}}
<style>
/* Topbar */
.topbar {
    border-bottom: 1px solid #2f9a9f;
}

/* Navbar Links */
.navmenu ul { list-style:none; margin:0; padding:0; }
.navmenu ul li { position:relative; margin:0 10px; }
.navmenu ul li a {
    color:#333;
    text-decoration:none;
    font-weight:500;
    padding:8px 12px;
    transition:all 0.3s ease;
}
.navmenu ul li a:hover,
.navmenu ul li a.active { color:#3fbbc0; }

/* Dropdown Menu */
.navmenu .dropdown-menu {
    display:none;
    position:absolute;
    background:#fff;
    top:100%;
    left:0;
    min-width:180px;
    border-radius:8px;
    padding:10px 0;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    z-index:1000;
}
.navmenu ul li.dropdown:hover > .dropdown-menu { display:block; }
.navmenu .dropdown-menu li a { display:block; padding:8px 20px; color:#333; }
.navmenu .dropdown-menu li a:hover { background:#3fbbc0; color:#fff; }

/* Mobile Menu */
.mobile-nav-toggle { font-size:1.5rem; cursor:pointer; display:none; }
@media(max-width:1200px){
    .navmenu ul {
        flex-direction:column;
        background:#fff;
        position:fixed;
        top:70px;
        right:-100%;
        width:250px;
        height:calc(100% - 70px);
        padding:20px;
        transition:right 0.3s ease;
    }
    .navmenu ul li { margin:10px 0; }
    .mobile-nav-toggle { display:block; }
    .navmenu .dropdown-menu { position:relative; box-shadow:none; }
}
</style>

{{-- 🔹 Mobile Toggle JS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.mobile-nav-toggle');
    const menu = document.querySelector('#navmenu ul');
    toggle.addEventListener('click', () => {
        menu.style.right = (menu.style.right === '0px') ? '-100%' : '0px';
    });
});
</script>

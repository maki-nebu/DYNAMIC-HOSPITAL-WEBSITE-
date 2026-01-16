<footer id="footer" class="footer bg-white pt-5 pb-4 text-muted border-top">
    <div class="container">
        <div class="row gy-5">

            <!-- About / Brand -->
            <div class="col-lg-3 col-md-6 footer-about">
                <a href="{{ url('/') }}" class="d-flex align-items-center mb-3">
                    @if(!empty($setting->logo_footer))
                        <img src="{{ asset('uploads/Setting/' . $setting->logo_footer) }}" 
                             alt="Logo" style="max-height: 60px;">
                    @else
                        <h3 class="text-dark fw-bold">{{ $setting->siteTitle ?? 'Hospital' }}</h3>
                    @endif
                </a>
                @if(!empty($setting->SiteMoto))
                    <p class="small">
                        {{ app()->getLocale() == 'am' ? ($setting->SiteMoto_am ?? $setting->SiteMoto) : $setting->SiteMoto }}
                    </p>
                @endif
                @if(!empty($setting->about_us))
                    <p class="small mt-2">
                        {{ app()->getLocale() == 'am' 
                            ? Str::limit($setting->about_us_am ?? $setting->about_us, 120) 
                            : Str::limit($setting->about_us, 120) }}
                    </p>
                @endif
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 footer-links">
                <h5 class="fw-bold text-dark mb-3">
                    {{ app()->getLocale() == 'am' ? 'ፈጣን ማስተዳደር' : 'Quick Links' }}
                </h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-muted">{{ app()->getLocale() == 'am' ? 'መነሻ' : 'Home' }}</a></li>
                    <li><a href="{{ route('about.page') }}" class="text-muted">{{ app()->getLocale() == 'am' ? 'ስለ እኛ' : 'About Us' }}</a></li>
                    <li><a href="{{ route('services.frontend') }}" class="text-muted">{{ app()->getLocale() == 'am' ? 'አገልግሎቶች' : 'Services' }}</a></li>
                    <li><a href="{{ route('doctors.all') }}" class="text-muted">{{ app()->getLocale() == 'am' ? 'ዶክተሮች' : 'Doctors' }}</a></li>
                    <li><a href="{{ route('news') }}" class="text-muted">{{ app()->getLocale() == 'am' ? 'ዜና' : 'News' }}</a></li>
                    <li><a href="{{ route('faq.page') }}" class="text-muted">{{ app()->getLocale() == 'am' ? 'ጥያቄ እና መልስ' : 'FAQ' }}</a></li>
                </ul>
            </div>

<!-- Our Services -->
<div class="col-lg-2 col-md-6 footer-links">
    <h5 class="fw-bold text-dark mb-3">
        {{ app()->getLocale() === 'am' ? 'አገልግሎቶቻችን' : 'Our Services' }}
    </h5>
    <ul class="list-unstyled">
        @php
            use App\Models\Service;
            $services = Service::where('status',1)->inRandomOrder()->take(6)->get();
        @endphp
@foreach($services as $service)
    <li>
        <a href="{{ route('services.show', $service->id) }}" class="text-muted">
            @if(app()->getLocale() === 'am')
                {{ $service->name_am ?? $service->name_en }}
            @else
                {{ $service->name_en ?? 'Service' }}
            @endif
        </a>
    </li>
@endforeach

    </ul>
</div>

@if(!empty($setting->google_map))
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapModalLabel">{{ app()->getLocale() == 'am' ? 'ካርታ' : 'Map' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! $setting->google_map !!}
      </div>
    </div>
  </div>
</div>
@endif



            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 footer-contact">
                <h5 class="fw-bold text-dark mb-3">
                    {{ app()->getLocale() == 'am' ? 'አድራሻችን' : 'Contact Us' }}
                </h5>
                <p class="small">
                    @if(!empty($setting->address))
                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                        {{ app()->getLocale() == 'am' ? ($setting->address_am ?? $setting->address) : $setting->address }}<br>
                    @endif
                    @if(!empty($setting->phone))
                        <i class="bi bi-telephone-fill me-2 text-primary"></i>{{ $setting->phone }}<br>
                    @endif
                    @if(!empty($setting->emailInfo))
                        <i class="bi bi-envelope-fill me-2 text-primary"></i>{{ $setting->emailInfo }}
                    @endif
                </p>
@if(!empty($setting->google_map))
    @php
        // Extract the src attribute from the iframe string
        preg_match('/src="([^"]+)"/', $setting->google_map, $matches);
        $mapSrc = $matches[1] ?? null;

        // Convert embed URL to normal Google Maps link
        // Example: /maps/embed?pb=... → /maps?pb=...
        $mapLink = $mapSrc ? str_replace("/maps/embed?", "/maps?", $mapSrc) : null;
    @endphp

    @if($mapLink)
        <a href="{{ $mapLink }}" target="_blank" class="btn btn-link text-muted small">
            {{ app()->getLocale() == 'am' ? 'በካርታ ላይ ይመልከቱ' : 'View on Map' }}
        </a>
    @endif
@endif


            </div>

            <!-- Social Media -->
            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold text-dark mb-3">
                    {{ app()->getLocale() == 'am' ? 'ይከተሉን' : 'Follow Us' }}
                </h5>
                <div class="d-flex gap-2">
                    @if(!empty($setting->facebook))
                        <a href="{{ $setting->facebook }}" class="social-icon text-muted fs-5"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if(!empty($setting->twitter))
                        <a href="{{ $setting->twitter }}" class="social-icon text-muted fs-5"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if(!empty($setting->instagram))
                        <a href="{{ $setting->instagram }}" class="social-icon text-muted fs-5"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if(!empty($setting->youtube))
                        <a href="{{ $setting->youtube }}" class="social-icon text-muted fs-5"><i class="bi bi-youtube"></i></a>
                    @endif
                    @if(!empty($setting->telegram))
                        <a href="{{ $setting->telegram }}" class="social-icon text-muted fs-5"><i class="bi bi-telegram"></i></a>
                    @endif
                    @if(!empty($setting->whatsapp))
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $setting->whatsapp) }}" class="social-icon text-muted fs-5"><i class="bi bi-whatsapp"></i></a>
                    @endif
                </div>
            </div>

        </div>

        <hr class="border-secondary mt-4">

        <!-- Footer Bottom -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
            <div>
                © {{ date('Y') }} <strong class="text-dark">{{ $setting->siteTitle ?? 'Hospital' }}</strong>. 
                {{ app()->getLocale() == 'am' ? 'መብቱ በሙሉ ተጠብቆ ነው።' : 'All Rights Reserved.' }}
            </div>
            <div class="text-muted mt-2 mt-md-0">
                {!! $setting->footer_note ?? '' !!}
            </div>
        </div>
    </div>

    <!-- Footer Styles -->
    <style>
        .footer a {
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer a:hover {
            color: #1a8fd2;
            padding-left: 3px;
        }
        .social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .social-icon:hover {
            background: #1a8fd2;
            color: #fff !important;
            transform: scale(1.1);
        }
    </style>
</footer>

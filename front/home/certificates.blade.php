<!-- ================== Certificates Section ================== -->
<section id="certificates" class="certificates section bg-light">
    @php
        $locale = app()->getLocale();
        $isAm = substr($locale, 0, 2) === 'am';
    @endphp

    <div class="container section-title" data-aos="fade-up">
        <h2>
            <a href="{{ route('accreditations.index') }}" class="text-dark text-decoration-none">
                {{ $isAm ? 'ማረጋገጫዎች' : 'Our Certificates and Awards' }}
            </a>
        </h2>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
            {
                "loop": true,
                "speed": 600,
                "autoplay": { "delay": 4000 },
                "slidesPerView": 1,
                "spaceBetween": 20,
                "centeredSlides": false,
                "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
                "breakpoints": {
                    "768": {"slidesPerView": 2, "spaceBetween": 20},
                    "1200": {"slidesPerView": 4, "spaceBetween": 20}
                }
            }
            </script>

            <div class="swiper-wrapper">
                @foreach($accreditations as $accreditation)
                    @if($accreditation->certificate && in_array(pathinfo($accreditation->certificate, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
                        <div class="swiper-slide">
                            <a href="{{ route('accreditations.index') }}" class="d-block">
                                <img src="{{ asset('storage/'.$accreditation->certificate) }}" 
                                     alt="{{ $isAm ? $accreditation->title_am : $accreditation->title_en }}"
                                     style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>
<style>

    .certificates .section-title h2 a {
    font-weight: 700;
    font-size: 32px;
}

.swiper-slide img {
    transition: transform 0.3s ease;
}
.swiper-slide img:hover {
    transform: scale(1.05);
}

</style>
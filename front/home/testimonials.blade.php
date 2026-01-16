<!-- ================== Testimonials Section ================== -->
<section id="testimonials" class="py-5" style="background: #f7f7f7;">
    <div class="container">
        @php
            $locale = app()->getLocale();
            $isAm = substr($locale, 0, 2) === 'am';
        @endphp

        <div class="row align-items-center">
            <!-- Left: Title + Description -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h2 class="fw-bold">
                    {{ $isAm ? 'የሕዝባችን እይታ' : 'Testimonials' }}
                </h2>
                <p class="text-muted">
                    {{ $isAm ? '' : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.' }}
                </p>
            </div>

            <!-- Right: Testimonial Slider -->
            <div class="col-lg-8" >
                <div class="p-4" style="background:#f7f7f7; border-radius: 0px; box-shadow: 0 8px 20px rgba(0,0,0,0.08);">
                    <div class="swiper testimonial-slider">
                        <div class="swiper-wrapper">
                            @foreach($testimonies as $testimony)
                                <div class="swiper-slide">
                                    <div class="testimonial-card d-flex flex-column flex-md-row align-items-center p-3">
                                        <!-- Photo -->
                                        <div class="testimonial-photo me-md-4 mb-3 mb-md-0">
                                            <img src="{{ $testimony->photo_url ? asset('storage/' . $testimony->photo_url) : asset('assets/images/default-user.png') }}" alt="{{ $isAm ? $testimony->name_am : $testimony->name_en }}">
                                        </div>

                                        <!-- Text + Name + Position -->
                                        <div class="testimonial-content text-center text-md-start">
                                            <p class="testimonial-text">
                                                “{{ $isAm ? $testimony->description_am : $testimony->description_en }}”
                                            </p>
                                            <h5 class="testimonial-name">
                                                {{ $isAm ? $testimony->name_am : $testimony->name_en }}
                                            </h5>
                                            <small class="testimonial-position">{{ $testimony->position }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Swiper Init Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".testimonial-slider", {
            loop: true,
            grabCursor: true,
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            speed: 1200,
        });
    });
</script>

<!-- Styles -->
<style>
/* Section Heading */
#testimonials h2 {
    font-size: 2rem;
}
#testimonials p {
    font-size: 1rem;
    color: #777;
}

/* Testimonial Card */
/* Testimonial Card */
.testimonial-card {
    background: #f7f7f7; /* lighter for inside slider card */
    /* border-radius: 15px; */

    transition: transform 0.3s ease, box-shadow 0.3s ease;

    /* New width & height for narrower and taller look */
    max-width: 500px;       /* narrower */
    min-height: 220px;      /* taller */
    margin: 0 auto;         /* center inside swiper-slide */
    padding: 2rem;          /* more vertical padding */
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Photo */
.testimonial-photo img {
    width: 80px;   /* slightly smaller to fit taller card */
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #3fbbc0;
}

/* Photo */
.testimonial-photo img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #3fbbc0;
}

.testimonial-content {
    flex: 1;              /* text takes remaining space */
    display: flex;
    flex-direction: column;
    justify-content: center; /* center text vertically */
}
.testimonial-text {
    font-size: 1rem;
    font-style: italic;
    color: #555;
    line-height: 1.6;
    margin-bottom: 1rem;
}


/* Text Content */
.testimonial-text {
    font-size: 1rem;
    font-style: italic;
    color: #555;
    line-height: 1.6;
    margin-bottom: 1rem;
}
.testimonial-name {
    font-weight: 700;
    color: #222;
    margin-bottom: 2px;
}
.testimonial-position {
    font-size: 0.9rem;
    color: #777;
}

/* Swiper Pagination */
.swiper-pagination-bullet {
    background: #3fbbc0;
}
.swiper-pagination-bullet-active {
    background: #2c9195;
}
</style>
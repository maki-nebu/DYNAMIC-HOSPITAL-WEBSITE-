@extends('front.layouts.app_white')
@section('content')
<!-- ===== Hero Section ===== -->
<section class="contact-hero" style="background-image: url('{{ asset('storage/hero/sample3.jpg') }}');">
    <div class="overlay">
        <div class="text-center hero-content animate__animated animate__fadeInDown">
            <h1 class="display-3 fw-bold mb-3">{{ __('contact.hero_title') }}</h1>
            <p class="lead mb-4">{{ __('contact.hero_subtitle') }}</p>
        </div>
    </div>
</section>

<!-- ===== Contact Form Section ===== -->
<section id="form-section" class="contact-section py-5">
    <div class="container">
        <div class="row align-items-stretch g-5">
            <!-- Image -->
<div class="col-lg-6 position-relative d-flex align-items-stretch">
    <img src="{{ asset('assets/images/new_folder/contact2.png') }}" 
         alt="{{ __('contact.contact_image_alt') }}" 
         class="img-fluid rounded shadow-lg w-100 h-100 object-fit-cover animate__animated animate__fadeInLeft">

 <div class="floating-card shadow-lg animate__animated animate__fadeInUp animate__delay-1s">
    <h5 class="mb-2">{{ __('contact.our_office') }}</h5>
    <p class="mb-0">{{ $settings->address ?? 'No address set' }}</p>
    <p class="mb-0">{{ __('contact.phone') }}: {{ $settings->phone ?? '+251 900 000 000' }}</p>
    <p class="mb-0">{{ __('contact.email') }}: {{ $settings->emailInfo ?? 'info@medicalcenter.et' }}</p>
</div>

</div>


            <!-- Form -->
            <div class="col-lg-6 d-flex align-items-center">
                <div class="card shadow-lg border-0 p-5 rounded w-100 animate__animated animate__fadeInRight">
                    <h2 class="fw-bold mb-4">{{ __('contact.form_title') }}</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">{{ __('contact.full_name') }}</label>
                            <input type="text" class="form-control border-primary shadow-sm form-input" name="name" id="name" placeholder="{{ __('contact.name_placeholder') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">{{ __('contact.email') }}</label>
                            <input type="email" class="form-control border-primary shadow-sm form-input" name="email" id="email" placeholder="{{ __('contact.email_placeholder') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">{{ __('contact.phone') }}</label>
                            <input type="text" class="form-control border-primary shadow-sm form-input" name="phone" id="phone" placeholder="{{ __('contact.phone_placeholder') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold">{{ __('contact.message') }}</label>
                            <textarea class="form-control border-primary shadow-sm form-input" name="message" id="message" rows="5" placeholder="{{ __('contact.message_placeholder') }}" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg text-white fw-bold send-btn">{{ __('contact.send_message') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ===== Complaint Section ===== -->
<section class="complaint-section py-5 bg-light">
    <div class="container text-center">
        <h3 class="fw-bold mb-3">{{ __('contact.complaint_title') }}</h3>
        <p class="mb-4">{{ __('contact.complaint_subtitle') }}</p>
        <a href="{{ route('complaint.create') }}" class="btn btn-warning btn-lg fw-bold">
            {{ __('contact.submit_complaint') }}
        </a>
    </div>
</section>

<!-- ===== Map Section ===== -->
<section class="map-section">
    <div class="container-fluid p-0">
        {!! $settings->google_map ?? '' !!}
    </div>
</section>



<style>
/* ===== Hero ===== */
.contact-hero {
    position: relative;
    min-height: 85vh;
    background-size: cover;
    background-position: center;
    display: grid;
    place-items: center;
    overflow: hidden;
}
.contact-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
}
.contact-hero .overlay {
    position: relative;
    z-index: 2;
    text-align: center;
    color: #fff;
    padding: 80px 20px;
}
.contact-hero h1 {
    font-size: 3.5rem;
    letter-spacing: 1px;
}
.contact-hero p {
    font-size: 1.25rem;
    max-width: 800px;
    margin: auto;
}

/* ===== Contact Section ===== */

.contact-section .object-fit-cover {
    object-fit: cover;
    width: 100%;
    height: 100%;
}
.row.align-items-stretch { align-items: stretch; }

.contact-section .floating-card {
    position: absolute;
    bottom: -25px;
    left: 20px;
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    width: 240px;
}
.contact-section .floating-card h5 { font-weight: 700; }
.contact-section .floating-card p { margin: 0; font-size: 0.85rem; color: #555; }

.contact-section form .form-input {
    transition: all 0.3s ease;
}
.contact-section form .form-input:focus {
    transform: scale(1.02);
    border-color: #3fbbc0;
    box-shadow: 0 6px 20px rgba(63,187,192,0.3);
}
.send-btn {
    background: linear-gradient(90deg,#3fbbc0,#2a6680);
    border-radius: 50px;
    padding: 12px 50px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.send-btn:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 12px 24px rgba(63,187,192,0.4);
}



/* ===== Map ===== */
.map-section iframe { border-radius: 12px; }

/* ===== Animations ===== */
.animate__animated { opacity: 0; animation-fill-mode: forwards; }
.animate__fadeInDown { animation-name: fadeInDown; animation-duration: 1s; }
.animate__fadeInLeft { animation-name: fadeInLeft; animation-duration: 1s; }
.animate__fadeInRight { animation-name: fadeInRight; animation-duration: 1s; }
.animate__fadeInUp { animation-name: fadeInUp; animation-duration: 1s; }
@keyframes fadeInDown { from {opacity:0; transform: translateY(-20px);} to {opacity:1; transform:none;} }
@keyframes fadeInLeft { from {opacity:0; transform: translateX(-20px);} to {opacity:1; transform:none;} }
@keyframes fadeInRight { from {opacity:0; transform: translateX(20px);} to {opacity:1; transform:none;} }
@keyframes fadeInUp { from {opacity:0; transform: translateY(20px);} to {opacity:1; transform:none;} }

@media(max-width: 991px) {
    .contact-hero h1 { font-size: 2.5rem; }
    .contact-hero p { font-size: 1.1rem; }
}
</style>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.contact-section form');
    form.addEventListener('submit', function(e){
        form.classList.add('was-validated');
    });
});
</script>
@endpush

@extends('front.layouts.app_white')

@section('content')

<section class="py-5" style="background: #f5f5f5;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-4 fw-bold text-dark">{{ __('Book an Appointment') }}</h2>
      <p class="lead text-secondary">{{ __('Schedule your visit with our expert doctors today. Fill out the form below and we’ll get back to you promptly!') }}</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 animate__fadeIn">
          <div class="card-body p-5" style="border-radius: 12px; background: #ffffff;">

            @if(session('success'))
              <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <form action="{{ route('appointment.submit') }}" method="POST" class="needs-validation" novalidate>
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="name" class="form-label fw-bold">{{ __('Full Name') }}</label>
                  <input type="text" class="form-control animated-input border-primary shadow-sm" name="name" id="name" placeholder="{{ __('Your Name') }}" required>
                </div>

                <div class="col-md-6">
                  <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
                  <input type="email" class="form-control animated-input border-primary shadow-sm" name="email" id="email" placeholder="you@example.com" required>
                </div>

                <div class="col-md-6">
                  <label for="phone" class="form-label fw-bold">{{ __('Phone Number') }}</label>
                  <input type="text" class="form-control animated-input border-primary shadow-sm" name="phone" id="phone" placeholder="+251..." required>
                </div>

                <div class="col-md-6">
                  <label for="doctor" class="form-label fw-bold">{{ __('Choose Doctor') }}</label>
                  <select name="doctor" id="doctor" class="form-select animated-input border-primary shadow-sm" required>
                    <option value="" selected disabled>{{ __('Select a doctor') }}</option>
                    @foreach($doctors as $doctor)
                      <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="date" class="form-label fw-bold">{{ __('Preferred Date') }}</label>
                  <input type="date" class="form-control animated-input border-primary shadow-sm" name="date" id="date" required>
                </div>

                <div class="col-md-6">
                  <label for="time" class="form-label fw-bold">{{ __('Preferred Time') }}</label>
                  <input type="time" class="form-control animated-input border-primary shadow-sm" name="time" id="time" required>
                </div>

                <div class="col-md-12">
                  <label for="message" class="form-label fw-bold">{{ __('Message (Optional)') }}</label>
                  <textarea class="form-control animated-input border-primary shadow-sm" name="message" id="message" rows="2" placeholder="{{ __('Any details...') }}"></textarea>
                </div>

              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn btn-lg fw-bold text-white btn-animated" style="background: #3fbbc0; border-radius: 50px; padding: 12px 50px;">
                  {{ __('Book Now') }}
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


@section('styles')
<style>
/* Animate form inputs on focus */
.animated-input {
  transition: all 0.3s ease-in-out;
}
.animated-input:focus {
  transform: translateY(-3px);
  box-shadow: 0 4px 15px rgba(63, 187, 192, 0.5);
  border-color: #3fbbc0;
  color: #000; /* ensure input text is black on focus */
}

/* Animate button hover */
.btn-animated {
  transition: all 0.3s ease-in-out;
}
.btn-animated:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 20px rgba(63, 187, 192, 0.6);
}

/* Fade-in animation for card */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px);}
  to { opacity: 1; transform: translateY(0);}
}
.animate__fadeIn {
  animation: fadeIn 1s ease forwards;
}

/* Doctor dropdown text visibility */
.form-select option {
    color: #000;           /* black text */
    background-color: #fff; /* white background */
}

/* Placeholder option styling */
.form-select option[disabled] {
    color: #6c757d; /* grey placeholder */
}
</style>


@endsection

<div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
    <div class="card doctor-card shadow-sm border-0 h-100 position-relative overflow-hidden">
        <!-- Doctor Image -->
        <div class="doctor-img position-relative">
            <img src="{{ asset('storage/doctors/' . $doctor->image) }}" alt="{{ $doctor->name_en }}">
            <div class="hover-overlay d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="text-white mb-1">{{ app()->getLocale() == 'am' ? $doctor->name_am : $doctor->name_en }}</h5>
                <span class="badge bg-info mb-2">{{ app()->getLocale() == 'am' ? $doctor->speciality_am : $doctor->speciality_en }}</span>
            </div>
        </div>
        <!-- Doctor Info -->
        <div class="card-body text-center p-3 d-flex flex-column justify-content-between">
            <h6 class="card-title mb-1">{{ app()->getLocale() == 'am' ? $doctor->name_am : $doctor->name_en }}</h6>
            <span class="text-muted d-block mb-2">{{ app()->getLocale() == 'am' ? $doctor->speciality_am : $doctor->speciality_en }}</span>
        </div>
    </div>
</div>

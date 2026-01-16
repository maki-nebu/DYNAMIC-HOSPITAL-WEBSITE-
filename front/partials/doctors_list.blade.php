@if($doctors->count())
    <div class="row g-4 justify-content-center">
        @foreach($doctors as $doctor)
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member shadow-sm">
                    <div class="member-img position-relative">
                        <img src="{{ asset('storage/'.$doctor->image) }}" class="img-fluid" alt="{{ $doctor->name_en }}">
                        <div class="social">
                            @if($doctor->facebook) <a href="{{ $doctor->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>@endif
                            @if($doctor->twitter) <a href="{{ $doctor->twitter }}" target="_blank"><i class="bi bi-twitter"></i></a>@endif
                            @if($doctor->instagram) <a href="{{ $doctor->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>@endif
                            @if($doctor->linkedin) <a href="{{ $doctor->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>@endif
                        </div>
                    </div>
                    <div class="member-info text-center p-3">
                        <h4>{{ app()->getLocale() === 'am' ? $doctor->name_am : $doctor->name_en }}</h4>
                        <span>{{ app()->getLocale() === 'am' ? $doctor->speciality_am : $doctor->speciality_en }}</span>
                        <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#doctorModal{{ $doctor->id }}">
                            View Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Doctor Modal -->
            <div class="modal fade" id="doctorModal{{ $doctor->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ app()->getLocale() === 'am' ? $doctor->name_am : $doctor->name_en }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/'.$doctor->image) }}" class="img-fluid rounded" alt="">
                            </div>
                            <div class="col-md-8">
                                <h6>{{ app()->getLocale() === 'am' ? $doctor->speciality_am : $doctor->speciality_en }}</h6>
                                <p>{{ app()->getLocale() === 'am' ? $doctor->description_am : $doctor->description_en }}</p>
                                <p><strong>Email:</strong> {{ $doctor->email }}</p>
                                <p><strong>Phone:</strong> {{ $doctor->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center text-muted">{{ __('doctors.no_doctors') }}</p>
@endif

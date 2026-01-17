<aside class="featuresAsideBlock position-relative text-white">
    <div class="container">
        <div class="flatpWrap position-relative mt-n8 mt-md-n18">
            <ul class="list-unstyled fabFeaturesList mb-0 d-flex overflow-hidden flex-wrap">
                @forelse($doctors as $doctor)
                    <li>
                        <a href="{{ route('front.finddoctor', ['search' => $doctor->name]) }}"
                           class="fflColumn d-block w-100 text-center px-2 pt-4 pb-10">
                            
                            {{-- Doctor Image --}}
                            <span class="icnWrap d-flex align-items-center justify-content-center mx-auto mb-4 rounded-circle overflow-hidden shadow"
                                  style="width: 100px; height: 100px;">
                                <img src="{{ !empty($doctor->image) 
                                    ? env('APP_URL') . '/uploads/doctors/' . $doctor->image
                                    : asset('images/default-doctor.jpg') }}"
                                     class="img-fluid rounded-circle"
                                     alt="{{ $doctor->name }}">
                            </span>
                            
                            {{-- Doctor Name --}}
                            <h2 class="mb-1">{{ $doctor->name }}</h2>
                            
                            {{-- Specialty --}}
                            <p class="mb-0 small text-muted">{{ $doctor->specialty }}</p>
                        </a>
                    </li>
                @empty
                    <li class="text-center w-100">{{ __('message.nothing') }}</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Bottom note + button --}}
    <div class="fabBtNoteTextWrap text-center fontAlter fzMedium pt-6 pt-md-10 pb-6 pb-md-10 pb-lg-14">
        <div class="container">
            <div class="d-lg-flex justify-content-center align-items-center">
                <p class="mb-lg-0">{{ __('message.explore_doctors') }}</p>
                <a href="{{ route('front.finddoctor') }}"
                   class="btn btn-dark btnSwitchDark fwMedium position-relative border-0 p-0 btnCustomSmall mt-md-1 mt-lg-0 ml-lg-4"
                   data-hover="{{ __('message.lets_more') }}">
                    <span class="d-block btnText fwMedium">{{ __('message.lets_more') }}</span>
                </a>
            </div>
        </div>
    </div>
</aside>

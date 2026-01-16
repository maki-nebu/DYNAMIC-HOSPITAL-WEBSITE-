@forelse($services as $service)
    <div class="col-12 col-md-6 col-xl-4">
        <article class="info-card will-animate text-center">
            <div class="thumb mb-2">
                <img src="{{ asset($service->image) }}" alt="Service Image"
                     class="img-fluid rounded shadow-sm"
                     onerror="this.src='{{ asset('assets/images/New folder/service5.jpg') }}'">
            </div>
            <h5 class="mb-2">{{ $service->name }}</h5>
            <a href="{{ route('services.show', $service->id) }}" 
               class="btn btn-outline-primary btn-sm">
               {{ __('services.view_details') }}
            </a>
        </article>
    </div>
@empty
    <p class="text-center text-muted">{{ __('services.no_services') }}</p>
@endforelse

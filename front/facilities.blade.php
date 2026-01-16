@extends('front.layouts.app_white')

@section('title', app()->getLocale() === 'am' ? 'መሣሪያዎቻችን' : __('Facilities'))

@section('content')

@php
    $locale = app()->getLocale();
    $isAm = substr($locale, 0, 2) === 'am';
@endphp

<!-- ===== Hero Section ===== -->
<section class="hero-section text-center text-white d-flex align-items-center justify-content-center" 
         style="background: url('{{ asset('assets/images/carousel/bg.avif') }}') center center/cover no-repeat; height: 300px; position: relative;">
    <div class="overlay" style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);"></div>
    <div class="container position-relative">
        <h1 class="display-4 fw-bold">{{ $isAm ? 'መሣሪያዎቻችን' : 'Our Facilities' }}</h1>
        <p class="lead">{{ $isAm ? 'ከጤናዎ እና ተስማሚ ሁኔታዎ የሚጠቀሙ የምርት እና ዘመናዊ መሣሪያዎችን ያሳያል።' : 'Explore the top-notch facilities we provide for your health and comfort.' }}</p>
    </div>
</section>

<!-- ===== Facilities Listing Section ===== -->
<section class="facilities-listing py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="section-title">{{ $isAm ? 'መሣሪያዎቻችን' : __('Facilities') }}</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            @forelse($facilities as $facility)
            <div class="col-md-6 col-lg-4 mb-5 text-center">
                <div class="card shadow-sm rounded-circle overflow-hidden facility-card mx-auto mb-3" style="width: 300px; height: 300px; transition: transform 0.3s;">
                    @if($facility->image)
                        <img src="{{ asset('storage/' . $facility->image) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $isAm ? ($facility->name_am ?? $facility->name_en) : ($facility->name_en ?? $facility->name_am) }}">
                    @else
                        <img src="{{ asset('assets/images/default-facility.jpg') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="No image">
                    @endif
                </div>
                <h5 class="fw-bold">{{ $isAm ? ($facility->name_am ?? $facility->name_en) : ($facility->name_en ?? $facility->name_am) }}</h5>
                <p class="text-muted">{{ Str::limit($isAm ? ($facility->description_am ?? $facility->description_en) : ($facility->description_en ?? $facility->description_am), 120) }}</p>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>{{ $isAm ? 'መሣሪያ አልተገኙም።' : __('No facilities found.') }}</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $facilities->links() }}
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
<style>
.facility-card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.hero-section h1 {
    text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
}

.hero-section p {
    text-shadow: 1px 1px 6px rgba(0,0,0,0.5);
}
</style>
@endsection

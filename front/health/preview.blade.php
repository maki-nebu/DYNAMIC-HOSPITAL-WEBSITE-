@extends('front.layouts.app_white')

@section('content')
<div class="container my-5">

    {{-- Health Info Card --}}
    <div class="card shadow-lg p-4 rounded-4 border-0">
        {{-- Title --}}
        <h2 class="mb-3 text-gradient fw-bold">
            {{ app()->getLocale() === 'am' ? $healthInfo->title_am : $healthInfo->title_en }}
        </h2>

        {{-- Description --}}
        <p class="text-muted">
            {{ app()->getLocale() === 'am' ? $healthInfo->description_am : $healthInfo->description_en }}
        </p>

        {{-- PDF Preview --}}
        <div class="mb-4" style="height: 600px;">
            <iframe src="{{ asset('storage/' . $healthInfo->file_path) }}"
                    width="100%" height="100%" style="border:1px solid #ccc;" allowfullscreen>
            </iframe>
        </div>

        {{-- Buttons --}}
        <div class="d-flex gap-2 mb-2">
            <a href="{{ route('healthinfo.download', $healthInfo->id) }}"
               class="btn btn-success btn-lg shadow-sm">
                <i class="fa fa-download me-1"></i>
                {{ app()->getLocale() === 'am' ? 'ያውርዱ' : __('Download PDF') }}
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg shadow-sm">
                <i class="fa fa-arrow-left me-1"></i>
                {{ app()->getLocale() === 'am' ? 'ተመለስ' : __('Back') }}
            </a>
        </div>

        {{-- Download count --}}
        <p class="text-muted mt-2">
            <i class="fa fa-download me-1"></i>
            {{ $healthInfo->download_count ?? 0 }}
            {{ app()->getLocale() === 'am' ? 'ጊዜ ወደረሰ' : 'Downloads' }}
        </p>
    </div>

    {{-- Related Health Info (static cards) --}}
@if($relatedInfos->count() > 0)
<div class="mt-5">
    <h3 class="fw-bold mb-4 text-gradient">
        {{ app()->getLocale() === 'am' ? 'ተዛማጅ መረጃዎች' : __('Related Health Information') }}
    </h3>

    <div class="row g-4">
        @foreach($relatedInfos as $related)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 hover-scale">
                {{-- Category Badge --}}
                @if($related->category)
                <span class="badge bg-info mb-2">
                    {{ app()->getLocale() === 'am' ? $related->category->name_am : $related->category->name_en }}
                </span>
                @endif

                {{-- Title --}}
                <h5 class="fw-bold text-dark mb-2">
                    {{ app()->getLocale() === 'am' ? $related->title_am : $related->title_en }}
                </h5>

                {{-- Description --}}
                <p class="text-muted flex-grow-1">
                    {{ Str::limit(app()->getLocale() === 'am' ? $related->description_am : $related->description_en, 100) }}
                </p>

                {{-- Buttons --}}
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('healthinfo.preview', $related->id) }}"
                       class="btn btn-outline-primary btn-sm">
                       <i class="fa fa-eye"></i> {{ __('Preview') }}
                    </a>
                    <a href="{{ route('healthinfo.download', $related->id) }}"
                       class="btn btn-success btn-sm">
                       <i class="fa fa-download"></i> {{ __('Download') }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

</div>

@endsection

@section('styles')
<style>
.text-gradient {
    background: linear-gradient(90deg, #3fbbc0, #0077b6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.btn, .carousel-control-prev-icon, .carousel-control-next-icon {
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.card:hover, .hover-scale:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
</style>
@endsection

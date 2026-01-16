@extends('front.layouts.app_white')

@section('title', __('Accreditations & Awards'))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
/* ===== Page Hero ===== */
.page-hero {
  padding: 40px 0;
  background: linear-gradient(135deg, #3fbcc0, #1aa3b0);
  color: #fff;
  position: relative;
  overflow: hidden;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}
.page-hero h1 {
  font-weight: 700;
  font-size: 2.5rem;
}
.page-hero p.lead {
  font-size: 1.1rem;
  color: rgba(255,255,255,0.85);
}
.page-hero .stats {
  margin-top: 15px;
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  color: rgba(255,255,255,0.85);
}
.page-hero .btn {
  border-radius: 30px;
  padding: 0.5rem 1.5rem;
  font-weight: 500;
  transition: all 0.3s ease;
}
.page-hero .btn-primary {
  background: #fff;
  color: #1aa3b0;
  border: none;
}
.page-hero .btn-primary:hover {
  background: #e0f7f9;
}

/* ===== Grid Cards ===== */
.accred-grid { 
  display: grid; 
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
  gap: 0; /* no gap horizontally or vertically */
}

.accred-card {
  background: #fff;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(11,22,39,0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  margin: 0; /* remove default spacing for grid */
}
.accred-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(11,22,39,0.12);
}

/* Card Image */
.accred-thumb {
  height: 200px;
  object-fit: cover;
  width: 100%;
  transition: transform 0.3s ease;
}
.accred-card:hover .accred-thumb {
  transform: scale(1.05);
}

/* Card Body */
.card-body {
  padding: 1rem 1.25rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}
.card-body h5 {
  font-weight: 600;
  margin-bottom: 0.5rem;
}
.card-body p {
  flex: 1;
  font-size: 0.95rem;
  color: #555;
  line-height: 1.4;
}

/* Meta Row */
.meta-row {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: #888;
  margin-bottom: 0.75rem;
}
.meta-row i {
  color: #1aa3b0;
  margin-right: 0.25rem;
}

/* Featured Badge */
.badge-featured {
  background: linear-gradient(90deg,#3fbbc0,#1aa3b0);
  color:#fff;
  font-weight: 500;
  font-size: 0.8rem;
  padding: 0.35rem 0.7rem;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* ===== Timeline ===== */
.timeline {
  border-left: 3px solid rgba(63,187,192,0.15);
  padding-left: 1.5rem;
  margin-top: 2rem;
}
.timeline .event {
  margin-bottom: 1.5rem;
  position: relative;
}
.timeline .event::before {
  content: '';
  position: absolute;
  left: -9px;
  top: 0;
  width: 12px;
  height: 12px;
  background: #1aa3b0;
  border-radius: 50%;
  border: 2px solid #fff;
}
.timeline .event strong {
  font-weight: 600;
  color: #1aa3b0;
}
.timeline .event .small {
  display: block;
  margin-top: 0.25rem;
  color: #666;
}

/* ===== Buttons ===== */
.btn-outline-primary {
  border-radius: 30px;
  padding: 0.4rem 1.2rem;
  transition: all 0.3s ease;
}
.btn-outline-primary:hover {
  background: #1aa3b0;
  color: #fff;
  border-color: #1aa3b0;
}

/* ===== Modal ===== */
.modal-content {
  border-radius: 15px;
}
.modal-header {
  border-bottom: none;
  padding-bottom: 0;
}
.modal-footer {
  border-top: none;
  padding-top: 0.75rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .page-hero h1 {
    font-size: 2rem;
  }
  .accred-thumb {
    height: 180px;
  }
  .timeline {
    padding-left: 1rem;
  }
}

.hero-wave svg {
  display: block;
  width: 100%;
  height: 80px;
}
.hero-wave {
  overflow: hidden;
  line-height: 0;
}

</style>
@endpush


@section('content')
<section class="page-hero position-relative">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="mb-1">{{ app()->getLocale() === 'am' ? 'ማረጋገጫዎች እና ሽልማቶች' : __('Accreditations & Awards') }}</h1>
        <p class="lead text-white mb-2">
          {{ app()->getLocale() === 'am' 
            ? 'እኛ ዓለም አቀፍ ደረጃዎችን እንጠብቃለን። የታመነ ድርጅቶች የሰጡትን ማረጋገጫዎች እና የሚያደርሱ ማረጋገጫ ፋይሎች በግልጽነት ይመልከቱ።' 
            : __('We uphold international standards. Browse our certifications, issued by trusted organizations, with transparent validity and downloadable certificates.') }}
        </p>

        <div class="stats text-white">
          <div class="small">{{ app()->getLocale() === 'am' ? 'ጠቅላላ' : __('Total') }}: <strong>{{ $total }}</strong></div>
          <div class="small">{{ app()->getLocale() === 'am' ? 'ተለይተው የታዩ' : __('Featured') }}: <strong>{{ $featuredCount }}</strong></div>
          <div class="small">{{ app()->getLocale() === 'am' ? 'በቅርቡ የሚያልፉ (90 ቀናት)' : __('Expiring soon (90d)') }}: <strong class="{{ $expiringSoon ? 'text-danger' : '' }}">{{ $expiringSoon }}</strong></div>
        </div>
      </div>

      <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
        <a href="#filters" class="btn btn-outline-primary me-2">{{ app()->getLocale() === 'am' ? 'ፈልግ' : __('Filters') }}</a>
        <a href="#timeline" class="btn btn-primary">{{ app()->getLocale() === 'am' ? 'ጊዜ መስመር' : __('Timeline') }}</a>
      </div>
    </div>
  </div>

  <!-- SVG Wave -->
  <div class="hero-wave position-absolute bottom-0 start-0 w-100">
    <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0,40 C360,120 1080,0 1440,60 L1440,120 L0,120 Z" fill="rgba(255,255,255,0.15)"/>
      <path d="M0,60 C360,0 1080,120 1440,40 L1440,120 L0,120 Z" fill="rgba(255,255,255,0.25)"/>
    </svg>
  </div>
</section>


<!-- Filters / Search -->
<section id="filters" class="py-4 bg-white">
  <div class="container">
    <form method="GET" class="row g-2 align-items-center">
      <div class="col-md-5">
        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="{{ app()->getLocale() === 'am' ? 'ርዕስ፣ ድርጅት ወይም መግለጫ ፈልግ...' : __('Search title, organization or description...') }}">
      </div>
      <div class="col-md-3">
        <select name="org" class="form-select">
          <option value="">{{ app()->getLocale() === 'am' ? 'ሁሉም ድርጅቶች' : __('All organizations') }}</option>
          @foreach($organizations as $org)
            <option value="{{ $org }}" @selected(request('org') == $org)>{{ $org }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <select name="sort" class="form-select">
          <option value="order" @selected(request('sort')=='order')>{{ app()->getLocale() === 'am' ? 'ነባር' : __('Default') }}</option>
          <option value="newest" @selected(request('sort')=='newest')>{{ app()->getLocale() === 'am' ? 'አዲስ አካባቢ' : __('Newest') }}</option>
          <option value="expiry_soon" @selected(request('sort')=='expiry_soon')>{{ app()->getLocale() === 'am' ? 'በቅርቡ የሚያልፉ' : __('Expiry soon') }}</option>
          <option value="featured" @selected(request('sort')=='featured')>{{ app()->getLocale() === 'am' ? 'ተለይተው የታዩ መጀመሪያ' : __('Featured first') }}</option>
        </select>
      </div>
      <div class="col-md-2 d-grid">
        <button class="btn btn-primary">{{ app()->getLocale() === 'am' ? 'አፈልግ' : __('Apply') }}</button>
      </div>
    </form>
  </div>
</section>

<!-- Cards Grid -->
<section class="py-5" style="background: #f7f9fb;">
  <div class="container">
    <div class="accred-grid">
      @foreach($accreditations as $a)
      @php
         $locale = app()->getLocale();
         $title = $a->{"title_$locale"} ?: $a->title_en;
         $org = $a->{"issuing_organization_$locale"} ?: $a->issuing_organization_en;
         $description = Str::limit($a->{"description_$locale"} ?: $a->description_en, 320);
         $issue = $a->issue_date ? \Carbon\Carbon::parse($a->issue_date)->format('Y-m-d') : null;
         $expiry = $a->expiry_date ? \Carbon\Carbon::parse($a->expiry_date)->format('Y-m-d') : null;
      @endphp

      <article class="accred-card">
        <div class="position-relative">
            @if($a->logo && file_exists(storage_path('app/public/'.$a->logo)))
                <img src="{{ asset('storage/'.$a->logo) }}" alt="{{ $title }}" class="accred-thumb w-100">
            @else
                <img src="https://images.unsplash.com/photo-1581091012184-7f3a5a2a6f8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="{{ $title }}" class="accred-thumb w-100">
            @endif

            <div class="position-absolute top-0 end-0 m-3">
                @if($a->is_featured)
                    <span class="badge badge-featured px-3 py-2">★ {{ app()->getLocale() === 'am' ? 'ተለይተው የታዩ' : __('Featured') }}</span>
                @endif
            </div>
        </div>

        <div class="card-body d-flex flex-column">
            <h5 class="mb-1">{{ $title }}</h5>
            <div class="meta-row mb-2">
                <div><i class="bi bi-building me-1"></i> <strong>{{ $org }}</strong></div>
                <div class="text-muted"> · </div>
                <div class="text-muted">{{ app()->getLocale() === 'am' ? 'የታወቀበት' : __('Issued') }}: <small>{{ $issue ?: (app()->getLocale() === 'am' ? '—' : '—') }}</small></div>
                <div class="text-muted"> · </div>
                <div class="text-muted">{{ app()->getLocale() === 'am' ? 'የሚያልፍ ቀን' : __('Expiry') }}: <small class="{{ $expiry && \Carbon\Carbon::parse($expiry)->isPast() ? 'text-danger' : '' }}">{{ $expiry ?: '—' }}</small></div>
            </div>

            <p class="text-muted mb-3">{!! nl2br(e($description)) !!}</p>

            <div class="d-flex gap-2 align-items-center">
              <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#accredModal{{ $a->id }}">
                {{ app()->getLocale() === 'am' ? 'ዝርዝር' : __('Details') }}
              </button>

              <a href="{{ $a->certificate ? asset('storage/'.$a->certificate) : 'javascript:void(0);' }}" 
                 class="btn btn-primary btn-sm" 
                 target="_blank" 
                 rel="noopener"
                 onclick="@if(!$a->certificate) alert('{{ app()->getLocale() === 'am' ? 'ማረጋገጫ አልተሰቀለም!' : 'No certificate uploaded yet!' }}'); return false; @endif">
                 <i class="bi bi-download"></i> {{ app()->getLocale() === 'am' ? 'ማረጋገጫ ክፈት' : __('View Certificate') }}
              </a>

              @if($a->certificate_id)
                <span class="small text-muted ms-auto">{{ app()->getLocale() === 'am' ? 'የማረጋገጫ መለያ' : __('Cert. ID') }}: <strong>{{ $a->certificate_id }}</strong></span>
              @endif
            </div>
        </div>
      </article>

      <!-- Modal: full details -->
      <div class="modal fade" id="accredModal{{ $a->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ $title }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-lg-4">
                  @if($a->logo && file_exists(storage_path('app/public/'.$a->logo)))
                    <img src="{{ asset('storage/'.$a->logo) }}" alt="{{ $title }}" class="img-fluid rounded">
                  @endif
                  <ul class="list-unstyled mt-3 small text-muted">
                    <li><strong>{{ app()->getLocale() === 'am' ? 'የሰጣበት ድርጅት' : __('Issuing Organization') }}:</strong> {{ $org }}</li>
                    <li><strong>{{ app()->getLocale() === 'am' ? 'የታወቀበት ቀን' : __('Issue Date') }}:</strong> {{ $issue ?: '—' }}</li>
                    <li><strong>{{ app()->getLocale() === 'am' ? 'የሚያልፍ ቀን' : __('Expiry Date') }}:</strong> {{ $expiry ?: '—' }}</li>
                    <li><strong>{{ app()->getLocale() === 'am' ? 'የማረጋገጫ መለያ' : __('Certificate ID') }}:</strong> {{ $a->certificate_id ?: '—' }}</li>
                    <li><strong>{{ app()->getLocale() === 'am' ? 'ሁኔታ' : __('Status') }}:</strong> {!! $a->expiry_date && \Carbon\Carbon::parse($a->expiry_date)->isPast() ? '<span class="text-danger">'.(app()->getLocale() === 'am' ? 'ያሎበት' : __('Expired')).'</span>' : '<span class="text-success">'.(app()->getLocale() === 'am' ? 'ተፈቃደ' : __('Valid')).'</span>' !!}</li>
                  </ul>
                  @if($a->certificate)
                    <a href="{{ asset('storage/'.$a->certificate) }}" class="btn btn-primary w-100" target="_blank"><i class="bi bi-file-earmark-pdf"></i> {{ app()->getLocale() === 'am' ? 'ማረጋገጫ ክፈት' : __('Open Certificate') }}</a>
                  @endif
                </div>
                <div class="col-lg-8">
                  <h6 class="mb-2">{{ app()->getLocale() === 'am' ? 'መግለጫ' : __('Description') }}</h6>
                  <div class="text-muted">{!! nl2br(e($a->{"description_".$locale} ?: $a->description_en)) !!}</div>

                  @if($a->full_texts)
                    <hr>
                    <h6>{{ app()->getLocale() === 'am' ? 'ሙሉ ጽሑፎች' : __('Full Texts') }}</h6>
                    <div class="small text-muted">{!! nl2br(e($a->full_texts)) !!}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">{{ app()->getLocale() === 'am' ? 'ዝጋ' : __('Close') }}</button>
            </div>
          </div>
        </div>
      </div>

      @endforeach
    </div>

    <div class="mt-4">
      {{ $accreditations->links() }}
    </div>
  </div>
</section>

<!-- Timeline + Highlights -->
<section id="timeline" class="py-5">
  <div class="container">
    <h3>{{ app()->getLocale() === 'am' ? 'የማረጋገጫ ጊዜ መስመር እና አስፋሪ ነጥቦች' : __('Accreditation Timeline & Highlights') }}</h3>
    <p class="text-muted">{{ app()->getLocale() === 'am' ? 'ቁልፍ ነጥቦች፣ የቅርብ ዘመን ሽልማቶች እና ማረጋገጫዎች' : __('Key milestones, recent awards and certifications') }}</p>

    <div class="row">
      <div class="col-lg-8">
        <div class="timeline">
          @foreach($accreditations->take(6) as $item)
            @php
              $year = $item->issue_date ? \Carbon\Carbon::parse($item->issue_date)->format('Y') : '';
            @endphp
            <div class="event">
              <strong>{{ $item->{"title_".$locale} ?: $item->title_en }}</strong>
              <div class="small text-muted">{{ $item->{"issuing_organization_".$locale} ?: $item->issuing_organization_en }} — <em>{{ $year }}</em></div>
              <div class="small text-muted mt-1">{!! Str::limit($item->{"description_".$locale} ?: $item->description_en, 200) !!}</div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="col-lg-4">
        <h6>{{ app()->getLocale() === 'am' ? 'ፈጣን እውነታዎች' : __('Quick Facts') }}</h6>
        <ul class="list-unstyled small text-muted">
          <li><strong>{{ $total }}</strong> — {{ app()->getLocale() === 'am' ? 'ጠቅላላ ማረጋገጫዎች' : __('Total accreditations') }}</li>
          <li><strong>{{ $featuredCount }}</strong> — {{ app()->getLocale() === 'am' ? 'ተለይተው የታዩ' : __('Featured') }}</li>
          <li><strong>{{ $expiringSoon }}</strong> — {{ app()->getLocale() === 'am' ? 'በ90 ቀናት ውስጥ የሚያልፉ' : __('Expiring within 90 days') }}</li>
        </ul>

        <div class="mt-3">
          <a href="{{ route('contacts.index') }}" class="btn btn-outline-primary w-100 mb-2">{{ app()->getLocale() === 'am' ? 'ለማረጋገጫ አግኝተው ያግኙን' : __('Contact us about verification') }}</a>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function(){
    // noop; modal handled by Bootstrap
  });
</script>
@endpush

@endsection


<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">

  <title>{{ __('search_results.doctors') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root { --brand:#3fbbc0; }
    .brand { color: var(--brand); }
    .btn-brand { background: var(--brand); border: none; color:#fff; }
    .btn-brand:hover { filter: brightness(.95); color:#fff; }
    .card { border: none; box-shadow: 0 6px 16px rgba(0,0,0,.08); }
  </style>
</head>
<body class="bg-white">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">

<h4 class="m-0 brand">{{ __('search_results.doctors') }}</h4>
      <a href="{{ url('/') }}" class="btn btn-sm btn-brand">{{ __('search_results.back') }}</a>

    </div>

    @if($doctors->count())
      <div class="row g-4">
        @foreach($doctors as $doctor)
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 text-center">
              @if(!empty($doctor->image))
                <img src="{{ asset('storage/doctors/' . $doctor->image) }}" 
                     class="img-fluid rounded-circle mx-auto mt-3" 
                     style="width: 120px; height: 120px; object-fit: cover;" 
                     alt="{{ $doctor->name_en }}">
              @endif

              <div class="card-body">
                <h5 class="card-title mb-1">
                  {{ app()->getLocale() == 'am' ? $doctor->name_am : $doctor->name_en }}
                </h5>
                @if(!empty($doctor->speciality_en))
                  <div class="text-muted small mb-2">
                    {{ app()->getLocale() == 'am' ? $doctor->speciality_am : $doctor->speciality_en }}
                  </div>
                @endif
                @if(!empty($doctor->email))
                  <div class="small">{{ $doctor->email }}</div>
                @endif
                @if(!empty($doctor->phone))
                  <div class="small">{{ $doctor->phone }}</div>
                @endif

                <div class="mt-3">
                  <a href="{{ route('doctor.show', $doctor->id) }}" class="btn btn-sm btn-brand">
                    {{ __('View') }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
<p class="text-center text-muted">{{ __('search_results.no_doctors_found') }}</p>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

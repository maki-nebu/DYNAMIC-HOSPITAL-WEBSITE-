<div class="row g-4">
    @foreach($newsItems as $news)
        <div class="col-md-6 col-lg-4">
              <div class="card shadow-sm border-0 h-100">
                <img src="{{ asset('user/assets/img/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $news->title }}</h5>
                    <small class="text-muted">{{ $news->date?->format('F j, Y') ?? 'No date' }} | {{ $news->category->name }}</small>
                    <p class="card-text mt-2">{{ $news->excerpt }}</p>
                    <button class="btn btn-custom mt-auto" data-bs-toggle="modal" data-bs-target="#newsModal{{ $news->id }}">Read More</button>
                </div>
            </div>

        </div>
    @endforeach
</div>

@foreach($newsItems as $news)
    <!-- Modal -->
    <div class="modal fade" id="newsModal{{ $news->id }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $news->id }}" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header" style="background:#3fbbc0; color:white;">
            <h5 class="modal-title" id="newsModalLabel{{ $news->id }}">{{ $news->title }}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="{{ asset('user/assets/img/' . $news->image) }}" class="img-fluid mb-3" alt="{{ $news->title }}">
            <p>{{ $news->content }}</p>
          </div>
        </div>
      </div>
    </div>
@endforeach


<!-- Pagination -->
<div class="mt-4">
    {{ $newsItems->links('pagination::bootstrap-5') }}
</div>

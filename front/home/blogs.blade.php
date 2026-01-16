<!-- ================== Our Blog Section ================== -->
<section class="blog-area section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="section-title">
                                    <p class="text-muted">
                    {{ app()->getLocale() === 'am' ? 'የብሎግ ጽሁፎቻችን' : 'Recent From Our Blog' }}
                </p>
                </h2>
            </div>
        </div>

        <div class="row">
            @foreach($latestNews as $news)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded overflow-hidden blog-card">
                        <a href="{{ route('news.show', $news->slug) }}">
                            <img src="{{ $news->image ? asset('storage/'.$news->image) : asset('front/img/default-news.jpg') }}" 
                                 class="card-img-top blog-img" 
                                 alt="{{ $news->title_en }}">
                        </a>
                        <div class="card-body">
                            <div class="mb-2 text-muted small">
                                <i class="bi bi-calendar-event"></i> {{ $news->published_at ? $news->published_at->format('M d, Y') : $news->created_at->format('M d, Y') }}
                                <span class="ms-2"><i class="bi bi-folder"></i> {{ $news->category?->name_en ?? 'General' }}</span>
                            </div>
                            <h5 class="card-title">
                                <a href="{{ route('news.show', $news->slug) }}" class="text-dark">
                                    {{ app()->getLocale() === 'am' ? $news->title_am : $news->title_en }}
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                {{ Str::limit(app()->getLocale() === 'am' ? $news->excerpt_am : $news->excerpt_en, 100) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<style>

.blog-area h2.section-title {
    margin-bottom: 0; /* reduce space under Recent From Blog */
}

.blog-area p {
    margin-top: 0;       /* remove extra gap */
    margin-bottom: 0;    /* optional, keep consistent */
}


.blog-area {
    padding: 40px 0;
}
.blog-card {
    transition: all 0.3s ease-in-out;
}
.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.blog-img {
    height: 220px;
    object-fit: cover;
}
.section-title {
    font-weight: 700;
    font-size: 32px;
}
</style>
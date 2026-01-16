@extends('front.layouts.app_white')

@section('content')
    
<style>
:root {
    --primary: #1a76d2;
    --secondary: #34a853;
    --accent: #f44336;
    --light: #f8f9fa;
    --dark: #212529;
    --transition: all 0.3s ease;
    --card-radius: 15px;
}

/* ---------- GENERAL ---------- */
body {
    font-family: 'Montserrat', sans-serif;
    color: #333;
    background: #f9fbfd;
    line-height: 1.6;
}

h1,h2,h3,h4,h5,h6 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
}

a {
    text-decoration: none;
    transition: var(--transition);
}

/* ---------- HERO SECTION ---------- */
.news-header {
    position: relative;
    min-height: 500px; 
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    overflow: hidden;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
    background: linear-gradient(135deg, rgba(26,118,210,0.7), rgba(52,168,83,0.7)), 
                url('{{ asset('assets/images/carousel/bg.avif') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-blend-mode: overlay;
    transition: background 0.5s ease;
     margin-bottom: 2rem;
}

.news-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.15));
    z-index: 1;
}

.news-header .container {
    position: relative;
    z-index: 2;
    padding: 0 15px;
}

.news-header h1 {
    font-size: 4rem; /* larger title */
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 4px 20px rgba(0,0,0,0.4);
    line-height: 1.2;
    animation: fadeInUp 1s ease forwards;
}

.news-header p.lead {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    animation: fadeInUp 1.2s ease forwards;
}

/* Hero search box */
.search-box {
    max-width: 550px;
    margin: 0 auto;
    animation: fadeInUp 1.4s ease forwards;
}

.search-box .input-group input {
    border-radius: 50px 0 0 50px;
    border: none;
    padding: 0.9rem 1.2rem;
    font-size: 1rem;
}

.search-box .input-group button {
    border-radius: 0 50px 50px 0;
    background: var(--primary);
    color: #fff;
    border: none;
    font-size: 1.1rem;
    padding: 0.9rem 1.2rem;
}

/* Hero animation keyframes */
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ---------- SECTION TITLES ---------- */
.section-title {
    position: relative;
    font-weight: 700;
    margin-bottom: 30px;
    padding-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 70px;
    height: 3px;
    background: var(--primary);
    border-radius: 3px;
}

/* ---------- FILTER BUTTONS ---------- */
.category-filter {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin-bottom: 40px;
}

.filter-btn {
    background: #fff;
    border: 2px solid var(--primary);
    color: var(--primary);
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: 600;
    transition: var(--transition);
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--primary);
    color: #fff;
}

/* ---------- FEATURED NEWS ---------- */
.featured-section {
    padding: 60px 0;
    background: linear-gradient(to right, #f8fafc, #f0f7ff);
}

.featured-news {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.featured-card {
    background: #fff;
    border-radius: var(--card-radius);
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: transform 0.35s, box-shadow 0.35s;
    display: flex;
    flex-direction: column;
}

.featured-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.featured-image {
    width: 100%;
    height: 240px;
    overflow: hidden;
    border-bottom: 1px solid #eee;
}

.featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.featured-card:hover .featured-image img {
    transform: scale(1.08);
}

.featured-content {
    padding: 20px 25px;
}

.featured-content .card-category {
    display: inline-block;
    background: var(--primary);
    color: #fff;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.featured-content .card-title {
    font-size: 1.4rem;
    margin-bottom: 12px;
    color: var(--dark);
    transition: color 0.3s;
}

.featured-card:hover .card-title {
    color: var(--primary);
}

.featured-content .card-excerpt {
    color: #555;
    line-height: 1.6;
    margin-bottom: 15px;
}

/* ---------- NEWS GRID ---------- */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.news-card {
    background: #fff;
    border-radius: var(--card-radius);
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
    transition: transform 0.35s, box-shadow 0.35s;
}

.news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 35px rgba(0,0,0,0.12);
}

.card-image {
    width: 100%;
    height: 180px;
    overflow: hidden;
    position: relative;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.news-card:hover .card-image img {
    transform: scale(1.08);
}

.card-content {
    padding: 18px 22px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.card-content .card-category {
    background: var(--primary);
    color: #fff;
    padding: 4px 12px;
    font-size: 0.75rem;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 8px;
}

.card-content .card-date {
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 8px;
}

.card-content .card-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--dark);
    transition: color 0.3s;
}

.news-card:hover .card-title {
    color: var(--primary);
}

.card-content .card-excerpt {
    color: #555;
    flex-grow: 1;
    line-height: 1.5;
    margin-bottom: 15px;
}

.card-content .card-stats {
    font-size: 0.85rem;
    color: #6c757d;
    display: flex;
    gap: 15px;
    margin-bottom: 10px;
}

.card-content .card-stats i {
    margin-right: 5px;
}

.read-more {
    font-weight: 600;
    color: var(--primary);
    display: inline-flex;
    align-items: center;
    transition: var(--transition);
}

.read-more i {
    margin-left: 6px;
    transition: transform 0.3s;
}

.read-more:hover i {
    transform: translateX(4px);
}

/* ---------- SIDEBAR ---------- */
.sidebar-widget {
    background: #fff;
    border-radius: var(--card-radius);
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.sidebar-title {
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

/* ---------- TAGS ---------- */
.tag {
    display: inline-block;
    background: #f0f7ff;
    color: var(--primary);
    padding: 5px 12px;
    border-radius: 20px;
    margin: 5px 5px 5px 0;
    font-size: 0.85rem;
    transition: all 0.3s;
}

.tag:hover {
    background: var(--primary);
    color: #fff;
}

/* ---------- PAGINATION ---------- */
.pagination {
    justify-content: center;
    margin-top: 40px;
}

.page-link {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 5px;
    border: 1px solid var(--primary);
    color: var(--primary);
}

.page-item.active .page-link {
    background: var(--primary);
    border-color: var(--primary);
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 992px) {
    .featured-news,
    .news-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .news-header {
        min-height: 500px;
        border-radius: 0;
    }
    .news-header h1 {
        font-size: 2.5rem;
    }
    .news-header p.lead {
        font-size: 1.2rem;
    }
}

.news-list li {
    margin-bottom: 8px;
}

.news-list li a {
    display: inline-block;
    background: #f0f7ff;
    color: var(--primary);
    padding: 5px 12px;
    border-radius: 20px;
    transition: all 0.3s;
}

.news-list li a:hover {
    background: var(--primary);
    color: #fff;
}

</style>

</head>
<body>
    <!-- Page Header -->
<div class="news-header" style="background-image: url('{{ asset('assets/images/carousel/bg5.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <h1 class="display-4 fw-bold">
            {{ app()->getLocale() === 'am' ? 'ዜና እና ማስታወቂያዎች' : 'News & Announcements' }}
        </h1>
        <p class="lead">
            {{ app()->getLocale() === 'am' 
                ? 'በተመለከተ የጤና ተቋማት ዜና፣ ዝግጅቶች እና የማህበረሰብ ተቋማት ዜና ያውቁ' 
                : 'Stay informed with the latest hospital news, events, and community initiatives' }}
        </p>
        
        <div class="search-box">
            <div class="input-group">
                <input type="text" class="form-control form-control-lg" 
                       placeholder="{{ app()->getLocale() === 'am' ? 'ዜና ይፈልጉ...' : 'Search news...' }}" 
                       id="newsSearch">
                <button class="btn btn-light" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>


    <!-- News Content -->
    <div class="container">
        <div class="row">
            <!-- Main News Content -->
            <div class="col-lg-8">
                <!-- Category Filters -->
                <div class="category-filter mb-4">
                    <button class="filter-btn active" data-category="all">
                        {{ app()->getLocale() === 'am' ? 'ሁሉም ዜና' : 'All News' }}
                    </button>
                    @foreach($categories as $category)
                        <button class="filter-btn" data-category="{{ $category->name_en }}">
                            {{ app()->getLocale() === 'am' ? $category->name_am : $category->name_en }}
                        </button>
                    @endforeach
                </div>

                <!-- Featured News Section -->
                <div class="featured-section mb-5">
                    <h2 class="section-title text-center center-title">
                        {{ app()->getLocale() === 'am' ? 'የተለዩ ታሪኮች' : 'Featured Stories' }}
                    </h2>
                    <div class="featured-news">
                        @if($featuredNews->count() > 0)
                            @foreach($featuredNews as $featured)
                                <div class="featured-card">
                                    <div class="featured-image">
                                        <img 
                                            src="{{ $featured->image ? asset('storage/' . $featured->image) : 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" 
                                            alt="{{ app()->getLocale() === 'am' ? $featured->title_am : $featured->title_en }}"
                                            class="img-fluid"
                                        >
                                    </div>

                                    <div class="featured-content">
                                        <span class="card-category">
                                            {{ is_object($featured->category) 
                                                ? (app()->getLocale() === 'am' ? $featured->category->name_am : $featured->category->name_en) 
                                                : (app()->getLocale() === 'am' ? 'ያልተመደበ' : 'Uncategorized') }}
                                        </span>

                                        <h3 class="card-title">
                                            {{ app()->getLocale() === 'am' ? $featured->title_am : $featured->title_en }}
                                        </h3>
                                        <p class="card-excerpt">
                                            {{ app()->getLocale() === 'am' 
                                                ? Str::limit($featured->excerpt_am, 150) 
                                                : Str::limit($featured->excerpt_en, 150) }}
                                        </p>
                                        <a href="{{ route('news.show', $featured->slug) }}" class="read-more">
                                            {{ app()->getLocale() === 'am' ? 'ሙሉ ታሪኩን ያንብቡ' : 'Read Full Story' }}
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">
                                {{ app()->getLocale() === 'am' ? 'ምንም የተለዩ ታሪኮች የሉም' : 'No featured stories available' }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- All News Grid -->
                <h2 class="section-title mb-3">
                    {{ app()->getLocale() === 'am' ? 'የቅርብ ጊዜ ዜና' : 'Latest News' }}
                </h2>
                @if($news->count() > 0)
                    <div class="news-grid" id="newsGrid">
                        @foreach($news as $item)
                            <div class="news-card" data-category="{{ is_object($item->category) ? $item->category->name_en : 'Uncategorized' }}">
                                <div class="card-image">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ app()->getLocale() === 'am' ? $item->title_am : $item->title_en }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="{{ app()->getLocale() === 'am' ? $item->title_am : $item->title_en }}">
                                    @endif
                                    <span class="card-category">
                                        {{ is_object($item->category) 
                                            ? (app()->getLocale() === 'am' ? $item->category->name_am : $item->category->name_en) 
                                            : (app()->getLocale() === 'am' ? 'ያልተመደበ' : 'Uncategorized') }}
                                    </span>
                                </div>
                                <div class="card-content">
                                    <div class="card-date">
                                        <i class="far fa-calendar-alt me-2"></i> {{ date('M d, Y', strtotime($item->published_at)) }}
                                    </div>
                                    <h3 class="card-title">
                                        {{ app()->getLocale() === 'am' ? $item->title_am : $item->title_en }}
                                    </h3>
                                    <p class="card-excerpt">
                                        {{ app()->getLocale() === 'am' 
                                            ? Str::limit($item->excerpt_am, 120) 
                                            : Str::limit($item->excerpt_en, 120) }}
                                    </p>
                                    <div class="card-stats">
                                        <span><i class="far fa-eye"></i> {{ $item->views }} {{ app()->getLocale() === 'am' ? 'ተመልከቷል' : 'views' }}</span>
                                        <span><i class="far fa-comments"></i> {{ $item->comments_count }} {{ app()->getLocale() === 'am' ? 'አስተያየቶች' : 'comments' }}</span>
                                    </div>
                                    <a href="{{ route('news.show', $item->slug) }}" class="read-more">
                                        {{ app()->getLocale() === 'am' ? 'ተጨማሪ ያንብቡ' : 'Read More' }}
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $news->links() }}
                    </div>
                @else
                    <div class="empty-state text-center">
                        <i class="far fa-newspaper"></i>
                        <h3>{{ app()->getLocale() === 'am' ? 'ምንም ዜና የለም' : 'No News Available' }}</h3>
                        <p>{{ app()->getLocale() === 'am' ? 'ለቅርብ ጊዜ ማዘመኛዎች እና ዜና ቆይተው ይመልከቱ።' : 'Check back later for the latest updates and news.' }}</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories Widget -->
                <div class="sidebar-widget mb-4">
                    <h3 class="sidebar-title">{{ app()->getLocale() === 'am' ? 'ምድቦች' : 'Categories' }}</h3>
                    <ul class="news-list">
                        @foreach($categories as $category)
                            <li>
                                <a href="#" data-category-filter="{{ $category->name_en }}">
                                    {{ app()->getLocale() === 'am' ? $category->name_am : $category->name_en }}
                                    <span class="float-end">({{ $category->news_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Popular News Widget -->
                <div class="sidebar-widget mb-4">
                    <h3 class="sidebar-title">{{ app()->getLocale() === 'am' ? 'ታዋቂ ዜና' : 'Popular News' }}</h3>
                    <ul class="news-list">
                        @foreach($popularNews as $popular)
                            <li>
                                <a href="{{ route('news.show', $popular->slug) }}">
                                    {{ app()->getLocale() === 'am' ? Str::limit($popular->title_am, 50) : Str::limit($popular->title_en, 50) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>


<!-- Newsletter Widget -->
<div class="sidebar-widget mb-4">
    <h3 class="sidebar-title">
        {{ app()->getLocale() === 'am' ? 'ዜና ደብዳቤ' : 'Newsletter' }}
    </h3>
    <p>
        {{ app()->getLocale() === 'am' 
            ? 'የቅርብ ጊዜ የጤና ዜና እና ማዘመኛዎች ለማግኘት ወደ ዜና ደብዳቤችን ይመዝገቡ።' 
            : 'Subscribe to our newsletter to get the latest health news and updates.' }}
    </p>

    <form action="{{ route('newsletter.subscribe') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="form-control"
                placeholder="{{ app()->getLocale() === 'am' ? 'የእርስዎ ኢሜይል አድራሻ' : 'Your Email Address' }}">
        </div>
        <button type="submit" class="btn btn-primary w-100">
            {{ app()->getLocale() === 'am' ? 'ይመዝገቡ' : 'Subscribe' }}
        </button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    @error('email')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
</div>



            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const newsCards = document.querySelectorAll('.news-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.getAttribute('data-category');

            // Remove 'active' class from all buttons
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Show/hide news cards
            newsCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || category === cardCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Optional: handle sidebar links too
    const sidebarLinks = document.querySelectorAll('[data-category-filter]');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category-filter');

            // Trigger corresponding top filter button
            const btn = Array.from(filterButtons).find(b => b.getAttribute('data-category') === category);
            if (btn) btn.click();
        });
    });
});
    </script>
@endsection
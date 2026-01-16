@extends('front.layouts.app_white')

@section('content')
<style>
:root {
    --primary: #1a76d2;
    --accent: #f44336;
    --light: #f8f9fa;
    --dark: #212529;
}
body {
    font-family: 'Montserrat', sans-serif;
    color: #333;
    line-height: 1.6;
    background: #f9fbfd;
}
h1,h2,h3,h4,h5 { font-family: 'Playfair Display', serif; }

/* Hero Section */
.hero-section {
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 220px 0 100px 0;
    text-align: center;
    position: relative;
}
.hero-section h1 { font-size: 3.5rem; }
.hero-section p { font-size: 1.5rem; }

/* Search Bar */
.search-bar { max-width: 700px; margin: 60px auto 50px auto; position: relative; z-index: 2; }

/* Health Info */
.health-container { display: flex; gap: 30px; margin-bottom: 50px; }
.health-left { flex: 1; max-width: 25%; }
.health-left h4 { font-weight: 700; margin-bottom: 20px; }
.category-list { list-style: none; padding: 0; }
.category-list li { padding: 10px 15px; margin-bottom: 8px; cursor: pointer; border-radius: 20px; background: #f1f1f1; transition: all 0.3s; }
.category-list li.active, .category-list li:hover { background: var(--primary); color: white; }

.health-right { flex: 3; display: flex; flex-direction: column; gap: 20px; }
.health-card { display: none; flex-direction: row; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 150px; }
.health-card.show { display: flex; }
.health-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.15); }
.card-image { flex: 1; overflow: hidden; }
.card-image img { width: 100%; height: 100%; object-fit: cover; }
.card-details { flex: 2; padding: 15px; display: flex; flex-direction: column; justify-content: space-between; }
.card-title { font-size: 1.1rem; font-weight: 600; margin: 0 0 5px 0; }
.card-description { font-size: 0.85rem; color: #555; margin: 0; }
.card-meta { display: flex; justify-content: flex-end; align-items: center; gap: 10px; }
.card-category { padding: 5px 15px; background: rgba(26,118,210,0.1); border-radius: 20px; font-size: 0.8rem; font-weight: 500; color: var(--primary); }
.download-btn { padding: 5px 15px; background: var(--primary); color: white; border-radius: 5px; text-decoration: none; font-size: 0.85rem; }
.download-count { font-size: 0.8rem; color: #555; }
.no-health-info { display: none; text-align: center; font-size: 1.2rem; color: #555; margin-top: 30px; }

/* Pagination */
.pagination-container { text-align: center; margin-top: 30px; }
.pagination-btn { display: inline-block; margin: 0 5px; padding: 8px 18px; border-radius: 20px; border: 1px solid var(--primary); background: white; color: var(--primary); cursor: pointer; transition: all 0.3s; }
.pagination-btn.active, .pagination-btn:hover { background: var(--primary); color: white; }


#pagination button {
    display: inline-block;
    margin: 0 5px;
    width: 35px;
    height: 35px;
    line-height: 35px;
    border-radius: 50%;
    border: 1px solid var(--primary);
    background: #f1f1f1;
    color: var(--primary);
    cursor: pointer;
    text-align: center;
    font-weight: 500;
    transition: all 0.3s;
}

#pagination button.active {
    background: var(--primary);
    color: white;
}

#pagination button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Responsive */
@media (max-width: 992px) {
    .health-container { flex-direction: column; }
    .health-left { max-width: 100%; }
    .health-right { flex: 1; }
    .health-card { flex-direction: column; height: auto; }
    .card-details { justify-content: flex-start; }
}
</style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1>
            {{ app()->getLocale() === 'am' ? 'የጤና መረጃና ሀብቶች' : __('Health Information & Resources') }}
        </h1>
        <p>
            {{ app()->getLocale() === 'am' ? 'ለሕክምና መረጃ፣ መመሪያዎችና ሀብቶች የታመነ ምንጭዎ' : __('Your trusted source for medical information, guides, and resources') }}
        </p>
    </div>
</section>

<!-- Search Bar -->
<div class="search-bar container">
    <input type="text" class="form-control form-control-lg" id="healthSearch"
        placeholder="{{ app()->getLocale() === 'am' ? 'የጤና መረጃ ፍለጋ...' : __('Search health information...') }}">
</div>

<!-- Health Content Section -->
<div class="container health-container">
    <div class="health-left">
        <h4>{{ app()->getLocale() === 'am' ? 'ምድቦች' : __('Categories') }}</h4>
        <ul class="category-list">
            <li class="active" data-category="all">{{ app()->getLocale() === 'am' ? 'ሁሉም' : __('All') }}</li>
            @foreach($categories as $category)
                <li data-category="{{ $category->id }}">
                    {{ app()->getLocale() === 'am' ? $category->name_am : $category->name_en }}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="health-right" id="healthCards">
        @foreach($healthInfos as $info)
            @if($info->is_active)
            <div class="health-card" data-category="{{ $info->category?->id }}">
                <div class="card-image">
                    <img src="{{ $info->thumbnail_path ? asset('storage/'.$info->thumbnail_path) : 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}"
                         alt="{{ app()->getLocale() === 'am' ? $info->title_am : $info->title_en }}">
                </div>
                <div class="card-details">
                    <div>
                        <h3 class="card-title">{{ app()->getLocale() === 'am' ? $info->title_am : $info->title_en }}</h3>
                        <p class="card-description">{{ app()->getLocale() === 'am' ? Str::limit($info->description_am, 100) : Str::limit($info->description_en, 100) }}</p>
                    </div>
                    <div class="card-meta">
                        <span class="card-category">
                            {{ app()->getLocale() === 'am'
                                ? ($info->category?->name_am ?? 'ያልተመዘገበ')
                                : ($info->category?->name_en ?? 'Uncategorized') }}
                        </span>
                        @if($info->file_path)
                        @if($info->file_path)
    <a href="{{ route('healthinfo.preview', $info->id) }}" class="preview-btn btn btn-sm btn-outline-primary" target="_blank">
        {{ app()->getLocale() === 'am' ? 'እይታ' : 'Preview' }}
    </a>
    <a href="{{ route('healthinfo.download', $info->id) }}" class="download-btn">
        {{ app()->getLocale() === 'am' ? 'ያውርዱ' : __('Download') }}
    </a>
@endif

                        <span class="download-count">{{ $info->download_count }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        <p class="no-health-info">
            {{ app()->getLocale() === 'am' ? 'የጤና መረጃ አልተገኘም።' : __('No health information found.') }}
        </p>
    </div>
</div>

<!-- Pagination Buttons -->
<div class="pagination-container" id="paginationButtons">
    <span class="pagination-btn" id="prevBtn">{{ app()->getLocale() === 'am' ? 'የቀድሞ' : 'Previous' }}</span>
    <span class="pagination-btn" id="nextBtn">{{ app()->getLocale() === 'am' ? 'ሚቀጥለው' : 'Next' }}</span>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const healthCards = Array.from(document.querySelectorAll('.health-card'));
    const categoryItems = document.querySelectorAll('.category-list li');
    const noInfo = document.querySelector('.no-health-info');
    const searchInput = document.getElementById('healthSearch');
    const paginationContainer = document.getElementById('paginationButtons');

    const itemsPerPage = 5;
    let currentPage = 1;
    let filteredCards = [];

    function filterCards(category = 'all', search = '') {
        filteredCards = healthCards.filter(card => {
            const matchesCategory = category === 'all' || card.dataset.category === category;
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const desc = card.querySelector('.card-description').textContent.toLowerCase();
            const matchesSearch = title.includes(search) || desc.includes(search);
            return matchesCategory && matchesSearch;
        });

        if(filteredCards.length === 0) {
            noInfo.style.display = 'block';
        } else {
            noInfo.style.display = 'none';
        }

        currentPage = 1;
        showPage();
        renderPagination();
    }

    function showPage() {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        healthCards.forEach(card => card.classList.remove('show'));
        filteredCards.slice(start, end).forEach(card => card.classList.add('show'));
    }

    function renderPagination() {
        paginationContainer.innerHTML = '';

        const totalPages = Math.ceil(filteredCards.length / itemsPerPage);

        // Previous button
        const prevBtn = document.createElement('span');
        prevBtn.textContent = '{{ app()->getLocale() === "am" ? "የቀድሞ" : "Previous" }}';
        prevBtn.className = 'pagination-btn';
        prevBtn.style.display = currentPage > 1 ? 'inline-block' : 'none';
        prevBtn.addEventListener('click', () => {
            if(currentPage > 1) { currentPage--; showPage(); renderPagination(); }
        });
        paginationContainer.appendChild(prevBtn);

        // Page numbers
        for(let i = 1; i <= totalPages; i++) {
            const pageBtn = document.createElement('span');
            pageBtn.textContent = i;
            pageBtn.className = 'pagination-btn' + (i === currentPage ? ' active' : '');
            pageBtn.addEventListener('click', () => {
                currentPage = i;
                showPage();
                renderPagination();
            });
            paginationContainer.appendChild(pageBtn);
        }

        // Next button
        const nextBtn = document.createElement('span');
        nextBtn.textContent = '{{ app()->getLocale() === "am" ? "ሚቀጥለው" : "Next" }}';
        nextBtn.className = 'pagination-btn';
        nextBtn.style.display = currentPage < totalPages ? 'inline-block' : 'none';
        nextBtn.addEventListener('click', () => {
            if(currentPage < totalPages) { currentPage++; showPage(); renderPagination(); }
        });
        paginationContainer.appendChild(nextBtn);
    }

    // Category click
    categoryItems.forEach(cat => {
        cat.addEventListener('click', () => {
            categoryItems.forEach(c => c.classList.remove('active'));
            cat.classList.add('active');
            filterCards(cat.dataset.category, searchInput.value.toLowerCase());
        });
    });

    // Search input
    searchInput.addEventListener('keyup', () => {
        const searchVal = searchInput.value.toLowerCase();
        const activeCategory = document.querySelector('.category-list li.active').dataset.category;
        filterCards(activeCategory, searchVal);
    });

    // Initial display
    filterCards();
});
</script>
@endsection

@extends('front.layouts.app_white')

@section('content')
<style>
/* FAQ Page Layout */
.faq-page {
    margin-top: 80px;
}
.faq-layout {
    display: flex;
    gap: 30px;
}

/* Left Sidebar */
.faq-sidebar {
    width: 25%;
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    height: fit-content;
    position: sticky;
    top: 100px;
}
.faq-sidebar h5 {
    font-weight: 700;
    margin-bottom: 15px;
}
.faq-sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.faq-sidebar li {
    margin-bottom: 10px;
}
.faq-sidebar a {
    text-decoration: none;
    color: var(--dark);
    font-weight: 500;
    display: block;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.faq-sidebar a:hover,
.faq-sidebar a.active {
    background: var(--primary);
    color: #fff;
}

/* Right FAQ Content */
.faq-content {
    flex: 1;
}
.faq-category-block {
    margin-bottom: 60px;
}
.faq-category-block h3 {
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 20px;
}

/* Existing FAQ Styles reused */
.faq-item { background: white; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); overflow: hidden; transition: all 0.3s ease; }
.faq-item:hover { box-shadow: 0 10px 25px rgba(0,0,0,0.15); transform: translateY(-2px); }
.faq-question { padding: 20px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: 1rem; font-weight: 600; color: var(--dark); width: 100%; border: none; background: none; text-align: left; }
.faq-question:focus { outline: none; }
.faq-icon { font-size: 1.1rem; color: var(--primary); transition: transform 0.3s ease; }
.faq-answer { padding: 0 20px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease; background: #f8fafc; color: #444; line-height: 1.7; }
.faq-item.active .faq-answer { max-height: 500px; padding: 0 20px 20px; }
.faq-item.active .faq-icon { transform: rotate(180deg); }

.no-results { text-align: center; padding: 40px; background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); display: none; }
.no-results i { font-size: 3rem; color: #ccc; margin-bottom: 15px; }

@media (max-width: 992px) {
    .faq-layout { flex-direction: column; }
    .faq-sidebar { width: 100%; position: relative; top: auto; }
}
</style>

{{-- Hero Section --}}
<section class="faq-hero py-5" style="background-color: #f5f5f5;">
    <div class="container text-center">
        <h2 class="display-5 fw-bold">
            {{ app()->getLocale() === 'am' ? 'በተደጋጋሚ የሚጠየቁ ጥያቄዎች' : 'Frequently Asked Questions' }}
        </h2>
        <p class="lead">
            {{ app()->getLocale() === 'am' ? 'የተለመዱ ጥያቄዎችን በአንድ ቦታ ያግኙ።' : 'Browse by category and find answers to common questions.' }}
        </p>
    </div>
</section>

{{-- Main FAQ Layout --}}
<section class="faq-page">
    <div class="container faq-layout">

        {{-- Left Sidebar Categories --}}
        <aside class="faq-sidebar">
            <h5>{{ app()->getLocale() === 'am' ? 'ምድቦች' : 'Categories' }}</h5>
            <ul>
                @foreach($faqCategories as $category)
                    <li>
                        <a href="#category-{{ $category->id }}">
                            {{ app()->getLocale() === 'am' ? $category->name_am : $category->name_en }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        {{-- Right Content --}}
        <div class="faq-content">
            {{-- Search --}}
            <div class="search-box mb-4">
                <div class="input-group">
                    <input type="text" class="form-control form-control-lg" 
                           placeholder="{{ app()->getLocale() === 'am' ? 'ጥያቄዎችን ይፈልጉ...' : __('Search questions...') }}" 
                           id="faqSearch">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            {{-- FAQ Categories and Items --}}
            @foreach($faqCategories as $category)
                <div class="faq-category-block" id="category-{{ $category->id }}">
                    <h3>{{ app()->getLocale() === 'am' ? $category->name_am : $category->name_en }}</h3>

                    @php
                        $categoryFaqs = $faqs->where('faq_category_id', $category->id);
                    @endphp

                    @foreach($categoryFaqs as $faq)
                        <div class="faq-item">
                            <button class="faq-question">
                                <span class="faq-text">
                                    {{ app()->getLocale() === 'am' ? $faq->question_am : $faq->question_en }}
                                </span>
                                <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                            </button>
                            <div class="faq-answer">
                                <p>{{ app()->getLocale() === 'am' ? $faq->answer_am : $faq->answer_en }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{-- No Results --}}
            <div id="noResults" class="no-results">
                <i class="fas fa-search"></i>
                <h4>{{ app()->getLocale() === 'am' ? 'ጥያቄ አልተገኘም' : __('No questions found') }}</h4>
                <p class="text-muted">{{ app()->getLocale() === 'am' ? 'ተለዋዋጭ መፈለጊያ ቃላትን ይሞክሩ' : __('Try different search terms') }}</p>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Accordion toggle
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            faqItems.forEach(other => { if(other !== item) other.classList.remove('active'); });
            item.classList.toggle('active');
        });
    });

    // Search filter
    const faqSearch = document.getElementById('faqSearch');
    const noResults = document.getElementById('noResults');
    faqSearch.addEventListener('keyup', function() {
        const val = this.value.toLowerCase();
        let visibleCount = 0;
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-text').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
            if(question.includes(val) || answer.includes(val)) {
                item.style.display = 'block';
                visibleCount++;
            } else item.style.display = 'none';
        });
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    });
});
</script>
@endsection

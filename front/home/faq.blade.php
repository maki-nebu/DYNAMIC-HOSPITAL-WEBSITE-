<style>
/* FAQ Section */
.faq-section { margin-top: 100px; }
.faq-container { max-width: 800px; margin: 0 auto 50px auto; }
.faq-item { background: white; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); overflow: hidden; transition: all 0.3s ease; }
.faq-item:hover { box-shadow: 0 10px 25px rgba(0,0,0,0.15); transform: translateY(-2px); }
.faq-question { padding: 25px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; background: white; border: none; width: 100%; text-align: left; font-size: 1.1rem; font-weight: 600; color: var(--dark); }
.faq-question:focus { outline: none; }
.faq-icon { font-size: 1.2rem; color: var(--primary); transition: transform 0.3s ease; }
.faq-answer { padding: 0 25px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease; background: #f8fafc; color: #444; line-height: 1.7; }
.faq-item.active .faq-answer { max-height: 500px; padding: 0 25px 25px; }
.faq-item.active .faq-icon { transform: rotate(180deg); }
.no-results { text-align: center; padding: 40px; background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); display: none; }
.no-results i { font-size: 3rem; color: #ccc; margin-bottom: 15px; }



@media (max-width: 768px) { 
    .hero-section { padding: 80px 0; } 
    .faq-question { padding: 20px; font-size: 1rem; } 
}

</style>


{{-- FAQ Hero/Title Section --}}
<section class="faq-hero py-5" style="background-color: #f5f5f5;">
    <div class="container text-center">
        <h2 class="display-5 fw-bold">
            {{ app()->getLocale() === 'am' ? 'በተደጋጋሚ የሚጠየቁ ጥያቄዎች' : 'Frequently Asked Questions' }}
        </h2>
        <p class="lead">
            {{ app()->getLocale() === 'am' ? 'ስለ ሆስፒታላችንና አገልግሎቶች የሚያስደርሱ የተለመዱ ጥያቄዎችን ያግኙ።' : 'Find answers to common questions about our hospital and services.' }}
        </p>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
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
        <div class="faq-container" id="faqContainer">
            @foreach($faqs as $faq)
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
        <div id="noResults" class="no-results">
            <i class="fas fa-search"></i>
            <h4>
                {{ app()->getLocale() === 'am' ? 'ጥያቄ አልተገኘም' : __('No questions found') }}
            </h4>
            <p class="text-muted">
                {{ app()->getLocale() === 'am' ? 'የተለያዩ መፈለጊያ ቃላትን ይሞክሩ' : __('Try different search terms') }}
            </p>
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
            // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            faqItems.forEach(other => { if(other !== item) other.classList.remove('active'); });
            item.classList.toggle('active');
        });
    });

    // FAQ Search
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
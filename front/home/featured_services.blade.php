
    <!-- Featured_services Section -->
<section id="featured-services" class="featured-services section">
  <div class="container">
    <div class="row gy-4">
      @foreach($features as $feature)
        <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
          <div class="service-item position-relative">
            <div class="icon"><i class="{{ $feature->icon }}"></i></div>
            <h4>
              <a href="{{ $feature->link ?? '#' }}" class="stretched-link">
                {{ app()->getLocale() == 'am' ? $feature->title_am : $feature->title_en }}
              </a>
            </h4>
            <p>
              {{ app()->getLocale() == 'am' ? $feature->description_am : $feature->description_en }}
            </p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- partnership -->
<section data-bs-version="5.1" class="clients1 cid-u7DdGlYAz5" id="clients1-3z">
    <div class="images-container container">
        <div class="mbr-section-head">
            <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-2 animate__animated animate__delay-1s animate__fadeIn">
                <strong>
                    <h3>
                        @if(app()->getLocale() === 'am')
                            አንዳንድ አጋሮቻችን
                        @else
                            Some of our partners
                        @endif
                    </h3>
                </strong>
            </h4>
        </div>

        <div class="marquee">
            <div class="marquee-inner">
                @foreach($partnerships as $partnership)
                    <div class="col-md-3 card">
                        <img src="{{ asset('storage/' . $partnership->logo) }}"
                             alt="{{ app()->getLocale() === 'am' ? $partnership->name_am : $partnership->name_en }}"
                             class="animate__animated animate__delay-1s animate__fadeIn">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .marquee {
          overflow: hidden;
          position: relative;
          width: 100%;
          background: #f7f7f7;
        }
        .marquee-inner {
          display: flex;
          gap: 2rem;
          animation: marquee-scroll 25s linear infinite;
        }
        .marquee-inner img {
          max-height: 100px;
          object-fit: contain;
        }
        @keyframes marquee-scroll {
          0%   { transform: translateX(0); }
          100% { transform: translateX(-50%); }
        }
    </style>
</section>

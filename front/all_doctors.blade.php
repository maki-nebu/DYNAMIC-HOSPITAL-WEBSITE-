@extends('front.layouts.app_white')

@section('content')

<!-- Hero Section-->
<section class="hero-doctors position-relative text-center text-white py-5" style="background: linear-gradient(135deg, rgba(15,31,45,0.85) 0%, rgba(63,187,192,0.75) 100%), url('{{ asset('assets/images/new_folder/bg.jpg') }}') center/cover no-repeat; min-height:80vh;">
    <div class="container position-relative d-flex flex-column justify-content-center align-items-center h-50" data-aos="fade-up" style="padding-top: 100px;">
        <h1 class="display-3 fw-bold mb-4">{{ __('doctors.hero_title') }}</h1>
        <p class="lead mb-5 fs-5">{{ __('doctors.hero_subtitle') }}</p>

        <!-- Search Bar in Hero - Redesigned -->
<!-- Increase the margin above the search bar -->
<form action="{{ route('doctor.search') }}" method="GET" class="d-flex align-items-center justify-content-center w-100 mt-5" id="doctorSearchForm" style="max-width:600px;">
    <div class="input-group w-100 position-relative rounded-pill shadow-lg overflow-hidden">
        <input type="text" name="search" id="searchInput" class="form-control border-0 py-3 px-4" 
               placeholder="{{ __('doctors.enter_doctor_name') }}" autocomplete="on" style="font-size:1.1rem;">
        <input type="hidden" name="filter" id="filterInput" value="name">

        <!-- Suggestions container -->
        <div id="suggestionsBox" 
             class="list-group position-absolute w-100 mt-1" 
             style="z-index: 1050; max-height:300px; overflow-y:auto; display:none; top:100%; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.15);">
        </div>

        <!-- <button class="btn btn-outline-light dropdown-toggle border-0 px-3" type="button" data-bs-toggle="dropdown" aria-expanded="true" style="background:rgba(255,255,255,0.1);">
            
        </button> -->
        <!-- <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#" data-filter="name">{{ __('doctors.search_by_name') }}</a></li>
            <li><a class="dropdown-item" href="#" data-filter="specialty">{{ __('doctors.search_by_specialty') }}</a></li>
        </ul> -->

        <div class="dropdown" style="display:none;" id="specialtyWrapper">
            <button class="btn btn-info dropdown-toggle border-0 px-4" type="button" id="specialtyButton" data-bs-toggle="dropdown" aria-expanded="false" style="background:var(--primary);">
                {{ __('doctors.select_specialty') }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end p-2" id="specialtyDropdown" style="max-height:200px; overflow-y:auto; min-width:200px;">
                <input type="text" class="form-control mb-2" id="specialtySearch" placeholder="{{ __('doctors.enter_specialty_name') }}">
                @foreach($specialties as $specialty)
                    <li><a class="dropdown-item specialty-item" href="#" data-value="{{ $specialty->name }}">
                        {{ $specialty->name }}
                    </a></li>
                @endforeach
            </ul>
        </div>

        <button class="btn text-white border-0 px-4 py-3" type="submit" style="background:var(--primary); font-weight:600;">
            <i class="bi bi-search me-2"></i>{{ __('doctors.search') }}
        </button>
    </div>
</form>
    </div>
</section>

<!-- Specialties Filter Section - Slightly Enhanced -->
<section class="specialties-filter py-4" style="background:#f8fafc;">
    <div class="container text-center">
        <div class="d-flex flex-wrap justify-content-center gap-3" id="specialtyButtonsWrap">
            <!-- Added ALL button (client-side) -->
            <form action="{{ route('doctor.search') }}" method="GET" style="display:inline;" class="js-filter-form">
                <input type="hidden" name="search" value="">
                <input type="hidden" name="filter" value="specialty">
                <button type="submit" class="btn btn-outline-primary rounded-pill px-4 py-2 category-btn" data-category="all" style="border-width:2px; font-weight:500;">
                    {{ app()->getLocale() == 'am' ? 'ሁሉም' : __('All') }}
                </button>
            </form>

            @foreach($specialties as $specialty)
                <form action="{{ route('doctor.search') }}" method="GET" style="display:inline;" class="js-filter-form">
                    <input type="hidden" name="search" value="{{ $specialty->name }}">
                    <input type="hidden" name="filter" value="specialty">
                    <button type="submit" class="btn btn-outline-primary rounded-pill px-4 py-2 category-btn" data-category="{{ strtolower($specialty->name) }}" style="border-width:2px; font-weight:500;">
                        {{ $specialty->name }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</section>


<!-- All Doctors Section - Card Layout Redesigned -->
<section id="all-doctors" class="doctors section bg-light py-4">
    <div class="container text-center mb-4" data-aos="fade-up">
        @if($doctors->count())
        <div class="row g-4 justify-content-center" id="doctorsGrid">
            @foreach($doctors as $doctor)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 doctor-item" data-specialty-en="{{ strtolower($doctor->speciality_en) }}" data-specialty-am="{{ strtolower($doctor->speciality_am) }}" data-name-en="{{ strtolower($doctor->name_en) }}" data-name-am="{{ strtolower($doctor->name_am) }}" data-id="{{ $doctor->id }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card doctor-card shadow-sm border-0 h-100 position-relative overflow-hidden" style="border-radius:16px; transition:all 0.4s ease;">

                    <!-- Doctor Image - Redesigned -->
                    <div class="doctor-img position-relative" style="height:280px; overflow:hidden;">
                       <img src="{{ asset('storage/doctors/' . $doctor->image) }}" alt="{{ $doctor->name_en }}" class="w-100 h-100" style="object-fit:cover; transition:transform 0.6s ease;">

                        <!-- Hover Overlay - Redesigned -->
                        <div class="hover-overlay d-flex flex-column justify-content-center align-items-center text-center p-4" style="background:rgba(15,31,45,0.9);">
                            <h5 class="text-white mb-2 fw-bold">{{ app()->getLocale() == 'am' ? $doctor->name_am : $doctor->name_en }}</h5>
                            <span class="badge bg-primary mb-3 px-3 py-2" style="font-size:0.9rem;">{{ app()->getLocale() == 'am' ? $doctor->speciality_am : $doctor->speciality_en }}</span>

                            <div class="social-icons d-flex mb-3">
                                <a href="{{ $doctor->facebook ?: '#' }}" target="_blank" onclick="event.stopPropagation();" rel="noopener noreferrer" class="btn btn-light btn-sm mx-1 rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="{{ $doctor->twitter ?: '#' }}" target="_blank" onclick="event.stopPropagation();" rel="noopener noreferrer" class="btn btn-light btn-sm mx-1 rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="{{ $doctor->instagram ?: '#' }}" target="_blank" onclick="event.stopPropagation();" rel="noopener noreferrer" class="btn btn-light btn-sm mx-1 rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="{{ $doctor->linkedin ?: '#' }}" target="_blank" onclick="event.stopPropagation();" rel="noopener noreferrer" class="btn btn-light btn-sm mx-1 rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </div>

                            @if(!empty($doctor->{"availability_" . app()->getLocale()}))
                                <ul class="availability-list text-white small text-center mt-2" style="list-style:none; padding:0;">
                                    @foreach(explode("\n", $doctor->{"availability_" . app()->getLocale()}) as $slot)
                                        <li class="mb-1">{{ $slot }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Doctor Info - Redesigned -->
                    <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="card-title mb-2 fw-bold fs-5" style="color:#0f1f2d;">{{ app()->getLocale() == 'am' ? $doctor->name_am : $doctor->name_en }}</h6>
                            <span class="text-primary d-block mb-3 fw-medium">{{ app()->getLocale() == 'am' ? $doctor->speciality_am : $doctor->speciality_en }}</span>
                        </div>

                        <button class="btn btn-outline-primary btn-sm mt-2 px-4 py-2" type="button" data-bs-toggle="modal" data-bs-target="#doctorModal{{ $doctor->id }}" style="border-width:2px; border-radius:20px; font-weight:500;">
                            {{ __('doctors.view_details') }}
                        </button>
                    </div>

                </div>
            </div>

            <!-- Doctor Modal (unchanged structure, just styling) -->
            <div class="modal fade" id="doctorModal{{ $doctor->id }}" tabindex="-1" aria-labelledby="doctorModalLabel{{ $doctor->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius:16px;">
                        <div class="modal-header bg-primary text-white border-0 py-4" style="border-radius:16px 16px 0 0;">
                            <h5 class="modal-title fw-bold" id="doctorModalLabel{{ $doctor->id }}">
                                {{ app()->getLocale() == 'am' ? $doctor->name_am : $doctor->name_en }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row p-4">
                            <div class="col-md-4 text-center mb-4">
                                <img src="{{ asset('storage/doctors/' . $doctor->image) }}"
                                     class="img-fluid rounded shadow-sm" 
                                     alt="{{ app()->getLocale() == 'am' ? $doctor->name_am : $doctor->name_en }}" style="max-height:200px; object-fit:cover;">
                                <h6 class="mt-3 text-primary fw-bold">{{ app()->getLocale() == 'am' ? $doctor->speciality_am : $doctor->speciality_en }}</h6>
                            </div>
                            <div class="col-md-8">
                                @if(!empty($doctor->{"description_" . app()->getLocale()}))
                                    <p class="text-secondary mb-4">{{ $doctor->{"description_" . app()->getLocale()} }}</p>
                                @endif
                                @if(!empty($doctor->{"availability_" . app()->getLocale()}))
                                    <h6 class="fw-bold mb-3">{{ __('doctors.availability') }}</h6>
                                    <ul class="availability-list" style="list-style:none; padding:0;">
                                        @foreach(explode("\n", $doctor->{"availability_" . app()->getLocale()}) as $slot)
                                            <li class="mb-2">{{ $slot }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="mt-4">
                                    <p class="mb-2"><strong>Email:</strong> {{ $doctor->email }}</p>
                                    <p class="mb-0"><strong>Phone:</strong> {{ $doctor->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 py-3">
                           <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius:8px;">{{ __('doctors.close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-muted no-doctors-message py-5 fs-5">{{ __('doctors.no_doctors') }}</p>
        @endif
    </div>
</section>

@endsection

<!-- Custom Styles - Only enhanced the existing ones -->
<style>
.hero-doctors {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-doctors .overlay { z-index: 1; }
.hero-doctors .container { z-index: 2; }
.hero-doctors h1, .hero-doctors p { color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
.hero-doctors .btn { transition: all 0.3s ease; }
.hero-doctors .btn:hover { transform: scale(1.05); }

/* Specialties Filter */
.specialties-filter {
    background: #f8fafc;
    padding: 40px 0;
}
.specialties-filter .btn {
    border-radius: 50px;
    transition: all 0.3s ease;
}
.specialties-filter .btn:hover {
    background-color: var(--primary);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(63, 187, 192, 0.3);
}

/* Doctor Card - Enhanced */
.doctor-card {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s ease;
    background: #fff;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    border: none;
}
.doctor-card:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 20px 40px rgba(0,0,0,0.15); 
}

/* Doctor Image */
.doctor-img { 
    position: relative; 
    overflow: hidden; 
    height: 280px; 
}
.doctor-img img { 
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
    transition: transform 0.6s ease; 
}
.doctor-card:hover .doctor-img img { 
    transform: scale(1.1); 
}

/* Hover Overlay - Enhanced */
.hover-overlay {
    position: absolute; 
    top: 0; 
    left: 0; 
    width: 100%; 
    height: 100%;
    background: rgba(15,31,45,0.9);
    display: flex; 
    flex-direction: column; 
    justify-content: center; 
    align-items: center;
    opacity: 0; 
    transform: translateY(10px);
    transition: all 0.4s ease;
    padding: 30px;
}
.doctor-card:hover .hover-overlay { 
    opacity: 1; 
    transform: translateY(0); 
}

/* Social Icons - Enhanced */
.social-icons a { 
    border-radius: 50%; 
    width: 40px; 
    height: 40px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    margin: 0 4px; 
    background: #fff; 
    color: #0f1f2d; 
    transition: all 0.3s ease; 
    transform: translateY(20px); 
    opacity: 0; 
}
.doctor-card:hover .social-icons a { 
    transform: translateY(0); 
    opacity: 1; 
}
.social-icons a:hover { 
    background: var(--primary); 
    color: #fff; 
    transform: scale(1.1); 
}

/* Availability List */
.availability-list { 
    list-style: none; 
    padding: 0; 
    margin: 10px 0 0 0; 
}
.availability-list li { 
    font-size: 0.9rem; 
    margin-bottom: 5px; 
    position: relative; 
}

.btn-outline-primary { 
    border-radius: 20px; 
    transition: all 0.3s ease; 
    font-weight: 500;
}
.btn-outline-primary:hover { 
    background: var(--primary); 
    color: #fff; 
    transform: scale(1.05); 
}

/* Show/hide animation for client-side filtering */
.doctor-item { 
    opacity: 0; 
    transform: translateY(10px); 
    transition: opacity 0.28s ease, transform 0.28s ease; 
    display: none; 
}
.doctor-item.show { 
    display: block; 
    opacity: 1; 
    transform: translateY(0); 
}

.no-doctors-message { 
    display: none; 
}

/* Responsive adjustments */
@media(max-width: 991px){ 
    .doctor-img { 
        height: 240px; 
    } 
    .hero-doctors h1 {
        font-size: 2.5rem;
    }
}
@media(max-width: 767px){ 
    .doctor-img { 
        height: 220px; 
    } 
    .hero-doctors h1 {
        font-size: 2rem;
    }
    .hero-doctors .lead {
        font-size: 1.1rem;
    }
}

</style>

<script>
// Your original JavaScript code remains completely unchanged
document.addEventListener('DOMContentLoaded', function() {
    // Locale for matching
    const locale = "{{ app()->getLocale() }}";

    // Elements
    const searchInput = document.querySelector('#searchInput');
    const filterInput = document.querySelector('#filterInput');
    const suggestionsBox = document.querySelector('#suggestionsBox');
    const doctorsGrid = document.getElementById('doctorsGrid');
    const doctorItems = Array.from(document.querySelectorAll('.doctor-item'));
    const categoryButtons = Array.from(document.querySelectorAll('.category-btn'));
    const noDoctorsMessage = document.querySelector('.no-doctors-message');

    // Normalize helper - strip "Dr." prefix and normalize
    const norm = str => {
        let normalized = (str || '').toString().trim().toLowerCase();
        // Remove "Dr." prefix if present for better matching
        normalized = normalized.replace(/^dr\.?\s*/i, '');
        return normalized;
    };

    // Initial show all
    function filterDoctors(category = 'all', search = '') {
        const searchNorm = norm(search);
        const categoryNorm = norm(category);

        let visibleCount = 0;

        doctorItems.forEach(item => {
            const name = locale === 'am' ? norm(item.dataset.nameAm) : norm(item.dataset.nameEn);
            const specialty = locale === 'am' ? norm(item.dataset.specialtyAm) : norm(item.dataset.specialtyEn);

            const matchesCategory = (categoryNorm === 'all' || categoryNorm === '' ) || specialty === categoryNorm;
            const matchesSearch = searchNorm === '' || name.includes(searchNorm) || specialty.includes(searchNorm);

            if(matchesCategory && matchesSearch) {
                item.classList.add('show');
                visibleCount++;
            } else {
                item.classList.remove('show');
            }
        });

        // show message when none
        if(visibleCount === 0) {
            if(noDoctorsMessage) {
                noDoctorsMessage.style.display = 'block';
                noDoctorsMessage.textContent = "No doctors found matching your search.";
            }
        } else {
            if(noDoctorsMessage) noDoctorsMessage.style.display = 'none';
        }
    }

    // Generate suggestions based on search input - FIXED SUGGESTIONS
    function generateSuggestions(searchTerm) {
        const searchNorm = norm(searchTerm);
        
        // Clear previous suggestions
        suggestionsBox.innerHTML = '';
        
        if (searchNorm.length < 1) {
            suggestionsBox.style.display = 'none';
            return;
        }

        const matches = [];
        
        doctorItems.forEach(item => {
            const name = locale === 'am' ? norm(item.dataset.nameAm) : norm(item.dataset.nameEn);
            const specialty = locale === 'am' ? norm(item.dataset.specialtyAm) : norm(item.dataset.specialtyEn);
            const displayName = locale === 'am' ? (item.dataset.nameAm || '') : (item.dataset.nameEn || '');
            const displaySpecialty = locale === 'am' ? (item.dataset.specialtyAm || '') : (item.dataset.specialtyEn || '');

            if (name.includes(searchNorm) || specialty.includes(searchNorm)) {
                matches.push({
                    displayName: displayName,
                    displaySpecialty: displaySpecialty,
                    searchValue: name.includes(searchNorm) ? displayName : displaySpecialty
                });
            }
        });

        if (matches.length === 0) {
            const noResultItem = document.createElement('a');
            noResultItem.href = '#';
            noResultItem.className = 'list-group-item list-group-item-action text-muted';
            noResultItem.textContent = 'No doctors found';
            noResultItem.addEventListener('click', function(e) {
                e.preventDefault();
                suggestionsBox.style.display = 'none';
            });
            suggestionsBox.appendChild(noResultItem);
        } else {
            matches.forEach(match => {
                const item = document.createElement('a');
                item.href = '#';
                item.className = 'list-group-item list-group-item-action';
                item.textContent = `${match.displayName} - ${match.displaySpecialty}`;
                item.dataset.value = match.searchValue;

                item.addEventListener('click', function(ev) {
                    ev.preventDefault();
                    searchInput.value = match.searchValue;
                    suggestionsBox.style.display = 'none';
                    filterDoctors('all', searchInput.value);
                });

                suggestionsBox.appendChild(item);
            });
        }

        suggestionsBox.style.display = 'block';
    }

    // Hook category buttons (they're wrapped in forms for graceful fallback)
    document.querySelectorAll('.js-filter-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // intercept server submit
            // read the button inside
            const btn = form.querySelector('.category-btn');
            const category = btn ? btn.dataset.category : 'all';

            // Update active styling
            categoryButtons.forEach(b => b.classList.remove('active'));
            if(btn) btn.classList.add('active');

            // Reset hero specialty dropdown to hidden
            document.querySelector('#specialtyWrapper').style.display = 'none';
            document.querySelector('#searchInput').style.display = 'inline-block';
            document.querySelector('#filterInput').value = 'name';

            // Run client-side filter
            filterDoctors(category, searchInput.value);
            suggestionsBox.style.display = 'none';
        });
    });

    // Also allow clicking on category-btn directly when not inside form
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // In case button is clicked directly
            e.preventDefault();
            const category = this.dataset.category || 'all';

            categoryButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            filterDoctors(category, searchInput.value);
            suggestionsBox.style.display = 'none';
        });
    });

    // Hook hero search form to intercept and do client filtering
    const doctorSearchForm = document.querySelector('#doctorSearchForm');
    if(doctorSearchForm) {
        doctorSearchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const currentFilter = document.querySelector('#filterInput').value || 'name';
            // If searching by specialty, map to category value
            if(currentFilter === 'specialty') {
                // If specialtyWrapper selected button value exists, use that; otherwise use search text
                const specialtyButton = document.querySelector('#specialtyButton');
                const specialtyVal = (specialtyButton && specialtyButton.textContent.trim() !== '{{ __('doctors.select_specialty') }}') ? specialtyButton.textContent.trim().toLowerCase() : searchInput.value.trim().toLowerCase();
                filterDoctors(specialtyVal, '');
            } else {
                filterDoctors('all', searchInput.value);
            }
            suggestionsBox.style.display = 'none';
        });
    }

    // Live typing for suggestions - SIMPLE FIXED VERSION
    if(searchInput) {
        let suggestionTimer = null;
        
        searchInput.addEventListener('input', function(e) {
            const query = this.value.trim();
            
            // Always run local filter as user types
            filterDoctors('all', query);

            // Handle suggestions with debounce
            if(suggestionTimer) clearTimeout(suggestionTimer);
            if(query.length < 1) { 
                suggestionsBox.style.display = 'none'; 
                return; 
            }

            suggestionTimer = setTimeout(() => {
                generateSuggestions(query);
            }, 200);
        });

        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length > 0) {
                generateSuggestions(this.value.trim());
            }
        });
    }

    // Specialty dropdown logic (unchanged behaviour, but when selecting a specialty we client-filter)
    document.querySelectorAll('.dropdown-item[data-filter]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.dataset.filter;
            document.querySelector('#filterInput').value = filter;

            if(filter === 'specialty') {
                document.querySelector('#specialtyWrapper').style.display = 'inline-block';
                document.querySelector('#searchInput').style.display = 'none';
            } else {
                document.querySelector('#specialtyWrapper').style.display = 'none';
                document.querySelector('#searchInput').style.display = 'inline-block';
            }
        });
    });

    document.querySelectorAll('.specialty-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const specialty = this.dataset.value;
            document.querySelector('#searchInput').value = specialty;
            document.querySelector('#filterInput').value = 'specialty';
            document.querySelector('#specialtyButton').textContent = specialty;
            // Client side filter by selected specialty
            filterDoctors(specialty.toLowerCase(), '');
            suggestionsBox.style.display = 'none';
        });
    });

    const specialtySearchInput = document.querySelector('#specialtySearch');
    if(specialtySearchInput) {
        specialtySearchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('.specialty-item').forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(filter) ? 'block' : 'none';
            });
        });
    }

    // Close suggestions on outside click
    document.addEventListener('click', function(e) {
        if (!suggestionsBox.contains(e.target) && e.target !== searchInput) {
            suggestionsBox.style.display = 'none';
        }
    });

    // Initial run to show all doctors
    filterDoctors('all', '');
});
</script>
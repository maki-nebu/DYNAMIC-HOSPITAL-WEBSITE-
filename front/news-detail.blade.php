@extends('front.layouts.app_white')

@section('content')
    
    <style>
        :root {
            --primary: #1a76d2;
            --secondary: #34a853;
            --accent: #f44336;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: #333;
            line-height: 1.7;
            background: #f9fbfd;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        .article-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                       url('{{ $newsItem->image ? asset('storage/' . $newsItem->image) : 'https://images.unsplash.com/photo-1576091160399-112ba8d25d15?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80' }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 6rem 0 4rem;
            margin-bottom: 3rem;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            margin-right: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .meta-item i {
            margin-right: 0.5rem;
            color: var(--primary);
        }
        
        .article-tag {
            background: var(--primary);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 1rem;
        }
        
        .article-content {
            font-size: 1.1rem;
            line-height: 1.9;
            color: #444;
        }
        
        .article-content h2 {
            margin: 2.5rem 0 1.5rem;
            color: var(--dark);
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .article-content h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary);
        }
        
        .article-content p {
            margin-bottom: 1.5rem;
        }
        
        .article-content blockquote {
            border-left: 4px solid var(--primary);
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: var(--gray);
            background: var(--light);
            padding: 2rem;
            border-radius: 0 8px 8px 0;
        }
        
        .article-content img {
            border-radius: 12px;
            margin: 2rem 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }
        
        .social-share {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .share-btn:hover {
            transform: translateY(-3px);
        }
        
        .facebook { background: #3b5998; }
        .twitter { background: #1da1f2; }
        .linkedin { background: #0077b5; }
        .whatsapp { background: #25d366; }
        
        .author-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin: 3rem 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
        }
        
        .author-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1.5rem;
            border: 3px solid var(--primary);
        }
        
        .related-articles {
            margin: 4rem 0;
        }
        
        .related-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: var(--transition);
            height: 100%;
        }
        
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .related-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }
        
        .related-content {
            padding: 1.5rem;
        }
        
        .related-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 2rem;
        }
        
        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--gray);
        }
        
        .sidebar-widget {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .sidebar-title {
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--light-gray);
            position: relative;
        }
        
        .sidebar-title:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: var(--primary);
        }
        
        .news-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .news-list li {
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .news-list li:last-child {
            border-bottom: none;
        }
        
        .news-list a {
            color: var(--dark);
            text-decoration: none;
            transition: var(--transition);
            display: block;
        }
        
        .news-list a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }
        
        .tag {
            display: inline-block;
            background: #f0f7ff;
            color: var(--primary);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            margin: 0.3rem;
            font-size: 0.85rem;
            transition: var(--transition);
            text-decoration: none;
        }
        
        .tag:hover {
            background: var(--primary);
            color: white;
        }
        
        .comment-section {
            margin: 4rem 0;
        }
        
        .comment-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .comment-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
        }
        
        @media (max-width: 768px) {
            .article-header {
                padding: 4rem 0 2rem;
            }
            
            .author-card {
                flex-direction: column;
                text-align: center;
            }
            
            .author-img {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .article-content {
                font-size: 1rem;
            }
        }

/* Comments Container */
#comments-container-{{ $newsItem->id }} {
    margin-top: 50px;
}

/* Each comment */
.comment {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
}

/* Replies */
.comment.reply {
    margin-left: 30px;
    background-color: #eef7f7;
    border-color: #b3e0e0;
}

/* Comment author */
.comment strong {
    color: #007b7f;
}

/* Timestamp */
.comment small {
    color: #666;
    font-size: 0.85rem;
}

/* Reply button */
.comment .reply-btn {
    font-size: 0.85rem;
    cursor: pointer;
}

.comment .reply-btn:hover {
    text-decoration: underline;
}

/* Comment form */
.comment-form {
    margin-top: 30px;
    padding: 20px;
    border: 1px solid #3fbbc0;
    border-radius: 10px;
    background-color: #f1fdfd;
}

.comment-form input,
.comment-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.comment-form button {
    background-color: #3fbbc0;
    border: none;
    padding: 10px 20px;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}

.comment-form button:hover {
    background-color: #35a6a9;
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

    <!-- Article Header -->
    <div class="article-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ app()->getLocale() === 'am' ? 'ዋና ገጽ' : 'Home' }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ app()->getLocale() === 'am' ? 'ዜና' : 'News' }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ app()->getLocale() === 'am' 
                            ? Str::limit($newsItem->title_am, 30) 
                            : Str::limit($newsItem->title_en, 30) }}
                    </li>
                </ol>
            </nav>
            
           <span class="article-tag">
              {{ app()->getLocale() === 'am' 
                  ? $newsItem->category?->name_am ?? 'N/A' 
                  : $newsItem->category?->name_en ?? 'N/A' }}
           </span>

            <h1 class="display-4 fw-bold mb-4">
                {{ app()->getLocale() === 'am' ? $newsItem->title_am : $newsItem->title_en }}
            </h1>
            
            <p class="lead mb-4">
                {{ app()->getLocale() === 'am' ? $newsItem->excerpt_am : $newsItem->excerpt_en }}
            </p>
            
            <div class="article-meta">
                <div class="meta-item">
                    <i class="far fa-calendar-alt"></i>
                    <span>{{ date('F j, Y', strtotime($newsItem->published_at)) }}</span>
                </div>
                <div class="meta-item">
                    <i class="far fa-clock"></i>
                   <span>{{ $readTime }} {{ app()->getLocale() === 'am' ? 'ደቂቃ ንባብ' : 'min read' }}</span>
                </div>
                <div class="meta-item">
                    <i class="far fa-eye"></i>
                    <span>{{ $newsItem->views }} {{ app()->getLocale() === 'am' ? 'ተመልከቷል' : 'views' }}</span>
                </div>
                <div class="meta-item">
                    <i class="far fa-user"></i>
                    <span>{{ app()->getLocale() === 'am' ? 'የጤና ተቋም አስተዳዳሪ' : 'Hospital Admin' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <article class="article-content">
                    <div>
                        {!! app()->getLocale() === 'am' ? $newsItem->content_am : $newsItem->content_en !!}
                    </div>
                </article>

                <!-- Comments count Section -->
<div class="comments-header mt-5 mb-3">
    <h3>
        {{ $newsItem->comments_count }}
        {{ app()->getLocale() === 'am' ? 'አስተያየቶች' : 'Comments' }}
    </h3>
</div>

<div id="comments-container-{{ $newsItem->id }}">
    @foreach($newsItem->comments()->whereNull('parent_id')->latest()->get() as $comment)
        <div class="comment" data-id="{{ $comment->id }}">
            <strong>{{ $comment->name }}</strong>
            <small>• {{ $comment->created_at->diffForHumans() }}</small>
            <p>{{ $comment->content }}</p>
            <a href="#" class="reply-btn text-primary" data-id="{{ $comment->id }}">Reply</a>

            @if($comment->replies->count() > 0)
                <!-- Toggle replies button -->
                <a href="#" class="toggle-replies text-secondary ms-2" data-id="{{ $comment->id }}">
                    ▼ {{ $comment->replies->count() }} {{ __('Replies') }}
                </a>

                <!-- Replies container (hidden by default) -->
                <div class="replies-container mt-2 ms-4" data-parent-id="{{ $comment->id }}" style="display: none;">
                    @foreach($comment->replies as $reply)
                        <div class="comment reply" data-id="{{ $reply->id }}">
                            <strong>{{ $reply->name }}</strong>
                            <small>• {{ $reply->created_at->diffForHumans() }}</small>
                            <p>{{ $reply->content }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>


<!-- Comment Form (below comments) -->
<form class="comment-form mt-4" data-id="{{ $newsItem->id }}">
    @csrf
    <!-- hidden field to hold parent comment ID when replying -->
    <input type="hidden" name="parent_id" value="">

    <div class="mb-2">
        <input type="text" name="name" class="form-control"
               placeholder="{{ app()->getLocale() === 'am' ? 'ስም' : 'Your Name' }}" required>
    </div>

    <div class="mb-2">
        <input type="email" name="email" class="form-control"
               placeholder="{{ app()->getLocale() === 'am' ? 'ኢሜል' : 'Your Email' }}" required>
    </div>

    <div class="mb-2">
        <textarea name="content" class="form-control"
                  placeholder="{{ app()->getLocale() === 'am' ? 'አስተያየትዎን አስገባ' : 'Write your comment...' }}" required></textarea>
    </div>

    <button type="submit" class="btn btn-custom">
        {{ app()->getLocale() === 'am' ? 'አስገባ' : 'Post Comment' }}
    </button>
</form>



                <!-- Social Sharing -->
                <div class="social-share">
                    <span class="me-2">
                        {{ app()->getLocale() === 'am' ? 'ይህን ጽሑፍ ያጋሩ፡' : 'Share this article:' }}
                    </span>
                    <a href="#" class="share-btn facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="share-btn twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="share-btn linkedin"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="share-btn whatsapp"><i class="fab fa-whatsapp"></i></a>
                </div>

                <!-- Author Info -->
                <div class="author-card">
                    <div class="author-img" style="background: linear-gradient(135deg, #3fbbc0, #1a76d2); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold;">
                        {{ app()->getLocale() === 'am' ? 'ጤ' : 'H' }}
                    </div>
                    <div>
                        <h5>
                            {{ app()->getLocale() === 'am' ? 'የጤና ተቋም ኮሙኒኬሽን ቡድን' : 'Hospital Communications Team' }}
                        </h5>
                        <p class="mb-0">
                            {{ app()->getLocale() === 'am' 
                                ? 'የሚደራጅበት ቡድናችን የቅርብ ጊዜ ልማቶች፣ የጤና ምክሮች እና የጤና ተቋም ዜና ለጤናዎ ጉዞ ለመደገፍ ለማሳወቅ ይሠራል።'
                                : 'Our dedicated team works to keep you informed about the latest developments, health tips, and hospital news to support your wellness journey.' }}
                        </p>
                    </div>
                </div>

                <!-- Related Articles -->
                <div class="related-articles">
                    <h3 class="sidebar-title">
                        {{ app()->getLocale() === 'am' ? 'የተዛመዱ ጽሑፎች' : 'Related Articles' }}
                    </h3>
                    <div class="row">
@php
    $relatedNews = App\Models\News::where('category_id', $newsItem->category->id)
        ->where('id', '!=', $newsItem->id)
        ->where('is_published', true)
        ->latest('published_at')
        ->take(3)
        ->get();
@endphp
                        @if($relatedNews->count() > 0)
                            @foreach($relatedNews as $related)
                            <div class="col-md-4 mb-4">
                                <div class="related-card">
                                    <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
     alt="{{ app()->getLocale() === 'am' ? $related->title_am : $related->title_en }}" class="img-fluid">
                                    <div class="related-content">
                                        <h5 class="related-title">
                                            {{ app()->getLocale() === 'am' ? Str::limit($related->title_am, 50) : Str::limit($related->title_en, 50) }}
                                        </h5>
                                        <a href="{{ route('news.show', $related->slug) }}" class="read-more">
                                            {{ app()->getLocale() === 'am' ? 'ተጨማሪ ያንብቡ' : 'Read More' }} <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-center">
                                {{ app()->getLocale() === 'am' ? 'ምንም የተዛመዱ ጽሑፎች አልተገኙም' : 'No related articles found' }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories Widget -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-title">{{ app()->getLocale() === 'am' ? 'ምድቦች' : 'Categories' }}</h3>
                    <ul class="news-list">
@php
    use App\Models\NewsCategory;
    $categories = NewsCategory::withCount(['news' => function($query) {
        $query->where('is_published', true);
    }])->get();
@endphp
@foreach($categories as $category)
    <li>
        <a href="#">
            {{ app()->getLocale() === 'am' ? $category->name_am : $category->name_en }}
            <span class="float-end">({{ $category->news_count }})</span>
        </a>
    </li>
@endforeach
                    </ul>
                </div>

                <!-- Popular News Widget -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-title">{{ app()->getLocale() === 'am' ? 'ታዋቂ ዜና' : 'Popular News' }}</h3>
                    <ul class="news-list">
                        @php
                            $popularNews = App\Models\News::where('is_published', true)
                                ->orderBy('views', 'desc')
                                ->take(5)
                                ->get();
                        @endphp
                        @foreach($popularNews as $popular)
                        <li>
                            <a href="{{ route('news.show', $popular->slug) }}">
                                {{ app()->getLocale() === 'am' ? Str::limit($popular->title_am, 50) : Str::limit($popular->title_en, 50) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>


 <!-- Bootstrap & jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // 1️⃣ Social Sharing Functionality
    const currentUrl = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);

    $('.facebook').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`);
    $('.twitter').attr('href', `https://twitter.com/intent/tweet?url=${currentUrl}&text=${title}`);
    $('.linkedin').attr('href', `https://www.linkedin.com/shareArticle?mini=true&url=${currentUrl}&title=${title}`);
    $('.whatsapp').attr('href', `https://wa.me/?text=${title}%20${currentUrl}`);

    // 2️⃣ Set parent_id when reply button clicked
    $(document).on('click', '.reply-btn', function(e) {
        e.preventDefault();
        const commentId = $(this).data('id');
        const form = $('.comment-form'); // single form at bottom

        // Update hidden parent_id input
        form.find('input[name="parent_id"]').val(commentId);

        // Scroll to the form
        $('html, body').animate({ scrollTop: form.offset().top - 100 }, 500);
    });

    // 3️⃣ Submit comment or reply via AJAX
    $(".comment-form").submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const newsId = form.data("id");
        const url = `/news/${newsId}/comment`;
        const formData = form.serialize();

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.success) {
                    const parentId = form.find('input[name="parent_id"]').val();
                    const isReply = parentId && parentId !== '';
                    
                    let newCommentHtml = `
                        <div class="comment${isReply ? ' reply ms-4 mt-2' : ''}" data-id="${response.comment.id}">
                            <strong>${response.comment.name}</strong>
                            <small>• ${response.comment.created_at}</small>
                            <p>${response.comment.content}</p>
                            ${!isReply ? `<a href="#" class="reply-btn text-primary" data-id="${response.comment.id}">Reply</a>` : ''}
                        </div>
                    `;

                    if (isReply) {
                        // Check if a replies container exists, if not, create one
                        let repliesContainer = $(`.replies-container[data-parent-id="${parentId}"]`);
                        if (repliesContainer.length === 0) {
                            repliesContainer = $(`<div class="replies-container ms-4 mt-2" data-parent-id="${parentId}" style="display:none;"></div>`);
                            $(`div.comment[data-id="${parentId}"]`).append(repliesContainer);
                            // Add toggle button
                            const toggleBtn = $(`<a href="#" class="toggle-replies text-primary mt-1 d-block" data-id="${parentId}">▼ 1 Replies</a>`);
                            $(`div.comment[data-id="${parentId}"]`).append(toggleBtn);
                        } else {
                            // update toggle button count
                            const toggleBtn = $(`.toggle-replies[data-id="${parentId}"]`);
                            const count = repliesContainer.children().length + 1;
                            toggleBtn.text(`▼ ${count} Replies`);
                        }

                        repliesContainer.append(newCommentHtml);
                    } else {
                        // top-level comment
                        $(`#comments-container-${newsId}`).prepend(newCommentHtml);
                    }

                    // Reset form
                    form[0].reset();
                    form.find('input[name="parent_id"]').val('');
                }
            },
            error: function(xhr) {
                alert("{{ app()->getLocale() === 'am' ? 'ችግር ተከስቷል፣ እባኮትን እንደገና ይሞክሩ።' : 'Something went wrong. Please try again.' }}");
            }
        });
    });

    // 4️⃣ Toggle replies visibility
    $(document).on('click', '.toggle-replies', function(e) {
        e.preventDefault();
        const parentId = $(this).data('id');
        const container = $(`.replies-container[data-parent-id="${parentId}"]`);
        container.slideToggle(200); // smooth toggle
        $(this).text(container.is(':visible') 
            ? `▲ ${container.children().length} Replies` 
            : `▼ ${container.children().length} Replies`);
    });
});
</script>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New News - Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Summernote WYSIWYG Editor -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <style>
    :root {
        --primary: #0d6efd;
        --secondary: #6c757d;
        --success: #198754;
        --danger: #dc3545;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    /* FIXED SIDEBAR LAYOUT */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px; /* adjust to your sidebar width */
        height: 100vh;
        overflow-y: auto;
        background-color: #fff; /* or match your sidebar color */
        border-right: 1px solid #dee2e6;
        z-index: 1000;
    }

    .content-area {
        margin-left: 250px; /* same as sidebar width */
        padding: 20px;
    }

    .page-header {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #eaeaea;
        font-weight: 600;
    }

    .nav-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        color: var(--secondary);
        font-weight: 500;
        padding: 0.75rem 1.5rem;
    }

    .nav-tabs .nav-link.active {
        color: var(--primary);
        border-bottom: 3px solid var(--primary);
        background: transparent;
    }

    .language-tab {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .required-field::after {
        content: '*';
        color: var(--danger);
        margin-left: 4px;
    }

    .image-preview {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        display: none;
        margin-top: 10px;
    }

    .slug-preview {
        background-color: #f8f9fa;
        padding: 0.5rem;
        border-radius: 4px;
        font-family: monospace;
        margin-top: 5px;
    }
</style>
</head>
<body>
    <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar">
            @include('layouts.admin') <!-- keep sidebar intact -->
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="page-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="h2 mb-0">Add New News Article</h1>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-light">
                                <i class="fas fa-arrow-left me-1"></i> Back to News
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="newsTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="english-tab" data-bs-toggle="tab" data-bs-target="#english" type="button" role="tab" aria-controls="english" aria-selected="true">
                                    <span class="language-tab">
                                        <i class="fas fa-language"></i> English Content
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="amharic-tab" data-bs-toggle="tab" data-bs-target="#amharic" type="button" role="tab" aria-controls="amharic" aria-selected="false">
                                    <span class="language-tab">
                                        <i class="fas fa-language"></i> Amharic Content
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                                    <span class="language-tab">
                                        <i class="fas fa-cog"></i> Settings
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card-body">
                        <div class="tab-content" id="newsTabsContent">
                            <!-- English Tab -->
                            <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title_en" class="form-label required-field">English Title</label>
                                            <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                                                   id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                                            @error('title_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug" class="form-label required-field">Slug (URL)</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                                   id="slug" name="slug" value="{{ old('slug') }}" required>
                                            <div class="form-text">This will be used in the URL. Use lowercase letters, numbers, and hyphens only.</div>
                                            <div class="slug-preview" id="slug-preview"></div>
                                            @error('slug')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="excerpt_en" class="form-label">English Excerpt</label>
                                            <textarea class="form-control @error('excerpt_en') is-invalid @enderror" 
                                                      id="excerpt_en" name="excerpt_en" rows="3">{{ old('excerpt_en') }}</textarea>
                                            <div class="form-text">A short summary of the news article (optional).</div>
                                            @error('excerpt_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="content_en" class="form-label required-field">English Content</label>
                                            <textarea class="form-control summernote @error('content_en') is-invalid @enderror" 
                                                      id="content_en" name="content_en" rows="10">{{ old('content_en') }}</textarea>
                                            @error('content_en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Amharic Tab -->
                            <div class="tab-pane fade" id="amharic" role="tabpanel" aria-labelledby="amharic-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title_am" class="form-label">Amharic Title</label>
                                            <input type="text" class="form-control @error('title_am') is-invalid @enderror" 
                                                   id="title_am" name="title_am" value="{{ old('title_am') }}">
                                            @error('title_am')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="excerpt_am" class="form-label">Amharic Excerpt</label>
                                            <textarea class="form-control @error('excerpt_am') is-invalid @enderror" 
                                                      id="excerpt_am" name="excerpt_am" rows="3">{{ old('excerpt_am') }}</textarea>
                                            <div class="form-text">A short summary of the news article in Amharic (optional).</div>
                                            @error('excerpt_am')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="content_am" class="form-label">Amharic Content</label>
                                            <textarea class="form-control summernote @error('content_am') is-invalid @enderror" 
                                                      id="content_am" name="content_am" rows="10">{{ old('content_am') }}</textarea>
                                            @error('content_am')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="row">
<div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select name="category_id" id="category_id" class="form-control" required>
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $news->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name_en }}
            </option>
        @endforeach
    </select>
</div>

                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="published_at" class="form-label required-field">Publish Date</label>
                                            <input type="date" class="form-control @error('published_at') is-invalid @enderror" 
                                                   id="published_at" name="published_at" value="{{ old('published_at', now()->format('Y-m-d')) }}" required>
                                            @error('published_at')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Featured Image</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                   id="image" name="image" accept="image/*">
                                            <div class="form-text">Recommended size: 1200x630 pixels. Max file size: 2MB.</div>
                                            <img id="imagePreview" class="image-preview" src="#" alt="Image preview">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
    <div class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Featured</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                {{ old('is_featured') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">Mark as Featured</label>
        </div>
        <div class="form-text">Toggle on to display in Featured Stories.</div>
    </div>
</div>


                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" checked>
                                                <label class="form-check-label" for="is_published">Published</label>
                                            </div>
                                            <div class="form-text">Toggle off to save as draft.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <div>
                                <button type="submit" name="draft" value="1" class="btn btn-outline-primary">Save as Draft</button>
                                <button type="submit" name="publish" value="1" class="btn btn-primary">Publish News</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote WYSIWYG Editor -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            
            // Generate slug from title
            $('#title_en').on('keyup blur', function() {
                const title = $(this).val();
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
                    .replace(/\s+/g, '-')        // Replace spaces with -
                    .replace(/-+/g, '-')         // Replace multiple - with single -
                    .replace(/^-+/, '')          // Trim - from start of text
                    .replace(/-+$/, '');         // Trim - from end of text
                
                $('#slug').val(slug);
                $('#slug-preview').text('URL: /news/' + slug).show();
            });
            
            // Image preview
            $('#image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // Form validation
            $('form').on('submit', function() {
                let valid = true;
                $('.required-field').each(function() {
                    const field = $(this).attr('for');
                    if (!$('#' + field).val()) {
                        valid = false;
                        $('#' + field).addClass('is-invalid');
                    }
                });
                
                if (!valid) {
                    $('.nav-tabs button').removeClass('active');
                    $('.tab-pane').removeClass('show active');
                    $('#english-tab').addClass('active');
                    $('#english').addClass('show active');
                    
                    alert('Please fill in all required fields.');
                    return false;
                }
                
                return true;
            });
        });
    </script>
</body>
</html>

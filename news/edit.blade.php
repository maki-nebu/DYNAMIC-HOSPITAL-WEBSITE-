@extends('layouts.admin')
@section('title','Edit News')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/dropify/css/dropify.min.css">
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit News</h2>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-arrow-left"></i>
                    </a>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg')

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                   @method('PUT')
                                <div class="row">
                                    <!-- Title EN -->
                                    <div class="col-md-6">
                                        <label for="title_en">Title (EN)</label>
                                        <input type="text" class="form-control" name="title_en" value="{{ old('title_en', $news->title_en) }}" required>
                                    </div>

                                    <!-- Title AM -->
                                    <div class="col-md-6">
                                        <label for="title_am">Title (AM)</label>
                                        <input type="text" class="form-control" name="title_am" value="{{ old('title_am', $news->title_am) }}">
                                    </div>

                                    <!-- Slug -->
                                    <div class="col-md-6 mt-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $news->slug) }}">
                                    </div>

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


                                    <!-- Excerpt EN -->
                                    <div class="col-md-6 mt-3">
                                        <label for="excerpt_en">Excerpt (EN)</label>
                                        <textarea class="form-control" name="excerpt_en" rows="3">{{ old('excerpt_en', $news->excerpt_en) }}</textarea>
                                    </div>

                                    <!-- Excerpt AM -->
                                    <div class="col-md-6 mt-3">
                                        <label for="excerpt_am">Excerpt (AM)</label>
                                        <textarea class="form-control" name="excerpt_am" rows="3">{{ old('excerpt_am', $news->excerpt_am) }}</textarea>
                                    </div>

                                    <!-- Content EN -->
                                    <div class="col-md-6 mt-3">
                                        <label for="content_en">Content (EN)</label>
                                        <textarea class="form-control" name="content_en" rows="5">{{ old('content_en', $news->content_en) }}</textarea>
                                    </div>

                                    <!-- Content AM -->
                                    <div class="col-md-6 mt-3">
                                        <label for="content_am">Content (AM)</label>
                                        <textarea class="form-control" name="content_am" rows="5">{{ old('content_am', $news->content_am) }}</textarea>
                                    </div>

                                    <!-- Published At -->
                                    <div class="col-md-6 mt-3">
                                        <label for="published_at">Published At</label>
                                        <input type="datetime-local" class="form-control" name="published_at" 
                                            value="{{ old('published_at', $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('Y-m-d\TH:i') : '') }}">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mt-3">
                                        <label for="is_published">Status</label>
                                        <select class="form-control" name="is_published">
                                            <option value="1" {{ $news->is_published == 1 ? 'selected' : '' }}>Published</option>
                                            <option value="0" {{ $news->is_published == 0 ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>

                                    <!-- Featured -->
<div class="col-md-6 mt-3">
    <label for="is_featured">Featured</label>
    <select class="form-control" name="is_featured">
        <option value="1" {{ $news->is_featured == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ $news->is_featured == 0 ? 'selected' : '' }}>No</option>
    </select>
</div>


                                    <!-- Image -->
                                    <div class="col-md-6 mt-3">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="dropify" 
                                            data-default-file="{{ $news->image ? asset('storage/news/'.$news->image) : '' }}">
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-primary btn-round">Update News</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- body -->
                    </div> <!-- card -->
                </div>
            </div>
        </div>
    </div>
</section>

@section('javascript')
<script src="/Smart/Admin/assets/plugins/dropify/js/dropify.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dropify').dropify();
    });
</script>
@stop
@endsection

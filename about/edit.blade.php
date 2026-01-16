@extends('layouts.admin')
@section('title','Edit About Entry')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Edit About Page Entry</h2>
                <a href="{{ route('admin.about.index') }}" class="btn btn-primary btn-icon">
                    <i class="zmdi zmdi-arrow-left"></i> Back
                </a>
            </div>

            @include('layouts.msg')

            <div class="card">
                <div class="body">
                    <form method="POST" action="{{ route('admin.about.update', $about->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="description" {{ $about->type=='description' ? 'selected' : '' }}>Description</option>
                                <option value="mission" {{ $about->type=='mission' ? 'selected' : '' }}>Mission</option>
                                <option value="vision" {{ $about->type=='vision' ? 'selected' : '' }}>Vision</option>
                                <option value="core" {{ $about->type=='core' ? 'selected' : '' }}>Core Values</option>
                                <option value="history" {{ $about->type=='history' ? 'selected' : '' }}>History</option>
                                <option value="milestone" {{ $about->type=='milestone' ? 'selected' : '' }}>Milestone</option>
                            </select>
                        </div>

                        <!-- Year field for milestones -->
                        <div class="form-group" id="year-group" style="display: {{ $about->type=='milestone' ? 'block' : 'none' }}">
                            <label for="year">Year</label>
                            <input type="text" name="year" class="form-control" value="{{ $about->year }}" placeholder="Enter Year">
                        </div>
<!-- history media -->
<div class="form-group" id="video-group" style="display: {{ $about->type=='history' ? 'block' : 'none' }}">
    <label for="history_video">YouTube Video URL (optional)</label>
    <input type="url" name="history_video" class="form-control" value="{{ $about->history_video }}" placeholder="https://www.youtube.com/watch?v=xxxx">

    @if($about->history_video)
        <p class="mt-2">Current Video:</p>
        <iframe width="100%" height="250" src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($about->history_video, 'v=') }}" frameborder="0" allowfullscreen></iframe>
    @endif

    <label for="history_image" class="mt-3">Optional History Image</label>
    <input type="file" name="history_image" class="form-control" accept="image/*">

    @if($about->image && $about->type=='history')
        <p class="mt-2">Current Image:</p>
        <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid mt-2" style="max-height:200px; object-fit:cover;">
    @endif
</div>



                        <!-- Image field for milestone or description -->
                        <div class="form-group" id="image-group" style="display: {{ ($about->type=='milestone' || $about->type=='description') ? 'block' : 'none' }}">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">

                            @if($about->image)
                                <p class="mt-2">Current image:</p>
                                <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid" style="max-height:200px; object-fit:cover; margin-bottom:10px;">
                                
                                <div class="form-check">
                                    <input type="checkbox" name="remove_image" value="1" class="form-check-input" id="removeImage">
                                    <label class="form-check-label" for="removeImage">Remove current image</label>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title_en">Title (English)</label>
                            <input type="text" name="title_en" class="form-control" value="{{ $about->title_en }}">
                        </div>

                        <div class="form-group">
                            <label for="title_am">Title (Amharic)</label>
                            <input type="text" name="title_am" class="form-control" value="{{ $about->title_am }}">
                        </div>

                        <div class="form-group">
                            <label for="content_en">Content (English)</label>
                            <textarea name="content_en" class="form-control" rows="5">{{ $about->content_en }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="content_am">Content (Amharic)</label>
                            <textarea name="content_am" class="form-control" rows="5">{{ $about->content_am }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Update Entry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const yearGroup = document.getElementById('year-group');
    const videoGroup = document.getElementById('video-group');
    const imageGroup = document.getElementById('image-group');

    function toggleFields() {
        // Show year field only for milestone
        if (typeSelect.value === 'milestone') {
            yearGroup.style.display = 'block';
        } else {
            yearGroup.style.display = 'none';
        }

        // Show media field only for history
        if (typeSelect.value === 'history') {
            videoGroup.style.display = 'block';
        } else {
            videoGroup.style.display = 'none';
        }

        // Show image field for milestone or description
        if (typeSelect.value === 'milestone' || typeSelect.value === 'description') {
            imageGroup.style.display = 'block';
        } else {
            imageGroup.style.display = 'none';
        }
    }
    typeSelect.addEventListener('change', toggleFields);

    // Initial check on page load
    toggleFields();
});
</script>
@endsection

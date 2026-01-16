@extends('layouts.admin')
@section('title','Add About Entry')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Add About Page Entry</h2>
                <a href="{{ route('admin.about.index') }}" class="btn btn-primary btn-icon">
                    <i class="zmdi zmdi-arrow-left"></i> Back
                </a>
            </div>

            @include('layouts.msg')

            <div class="card">
                <div class="body">
                    <form method="POST" action="{{ route('admin.about.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">-- Select Type --</option>
                                <option value="description">Description</option>
                                <option value="mission">Mission</option>
                                <option value="vision">Vision</option>
                                <option value="core">Core Values</option>
                                <option value="history">Hospital History</option>
                                <option value="milestone">Milestone</option>
                            </select>
                        </div>

                        <!-- Year field (for milestones) -->
                        <div class="form-group" id="year-field" style="display: none;">
                            <label for="year">Year</label>
                            <input type="text" name="year" id="year" class="form-control" placeholder="Enter Year" value="{{ old('year') }}">
                        </div>

                        <!-- YouTube URL field (for history) -->
                        <div class="form-group" id="video-url-field" style="display: none;">
                            <label for="history_video">History YouTube Video URL (optional)</label>
                            <input type="url" name="history_video" id="history_video" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('history_video') }}">
                            <small class="text-muted">Paste the full YouTube link here</small>
                        </div>

                        <!-- Image field for Milestone or Description -->
                        <div class="form-group" id="image-field" style="display: none;">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="title_en">Title (English)</label>
                            <input type="text" name="title_en" class="form-control" placeholder="English Title" value="{{ old('title_en') }}">
                        </div>

                        <div class="form-group">
                            <label for="title_am">Title (Amharic)</label>
                            <input type="text" name="title_am" class="form-control" placeholder="Amharic Title" value="{{ old('title_am') }}">
                        </div>

                        <div class="form-group">
                            <label for="content_en">Content (English)</label>
                            <textarea name="content_en" class="form-control" rows="5">{{ old('content_en') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="content_am">Content (Amharic)</label>
                            <textarea name="content_am" class="form-control" rows="5">{{ old('content_am') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Add Entry</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const yearField = document.getElementById('year-field');
    const videoUrlField = document.getElementById('video-url-field');
    const imageField = document.getElementById('image-field');

    function toggleFields() {
        // Year field only for milestone
        yearField.style.display = (typeSelect.value === 'milestone') ? 'block' : 'none';

        // YouTube URL field only for history
        videoUrlField.style.display = (typeSelect.value === 'history') ? 'block' : 'none';

        // Image field for milestone or description
        imageField.style.display = 
            (typeSelect.value === 'milestone' || typeSelect.value === 'description') 
            ? 'block' 
            : 'none';
    }

    typeSelect.addEventListener('change', toggleFields);
    toggleFields(); // run on page load
});
</script>
@endsection

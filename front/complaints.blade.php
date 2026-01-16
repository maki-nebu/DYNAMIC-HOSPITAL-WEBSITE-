@extends('front.layouts.app_white')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert" style="background-color: #3fbbc0; color: white;">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #3fbbc0; color: white;">
                    <h3>{{ __('complaint.title') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('complaint.store') }}" method="POST" enctype="multipart/form-data">
                       @csrf
                        <div class="mb-3">
                            <label>{{ __('complaint.name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('complaint.email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('complaint.address') }}</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('complaint.phone') }}</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('complaint.department') }}</label>
                            <input type="text" name="department" class="form-control" value="{{ old('department') }}">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('complaint.location') }}</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('complaint.description') }}</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>{{ __('complaint.file') }}</label>
                            <input type="file" name="file" class="form-control">
                            <small class="text-muted">Supported formats: jpg, jpeg, png, pdf. Max size: 5MB</small>
                        </div>
                        <button type="submit" class="btn" style="background-color: #3fbbc0; color: white;">{{ __('complaint.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

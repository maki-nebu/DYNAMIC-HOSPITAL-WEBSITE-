@extends('layouts.admin')
@section('title', isset($leader) ? 'Edit Leadership Member' : 'Add New Leadership Member')

@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>{{ isset($leader) ? 'Edit Leadership Member' : 'Add New Leadership Member' }}</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <a href="{{ route('admin.leadership.index') }}" class="btn btn-primary btn-icon float-right">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg') <!-- Success/error messages -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Leadership</strong> Information</h2>
                        </div>
                        <div class="body">
                            <form action="{{ isset($leader) ? route('admin.leadership.update', $leader->id) : route('admin.leadership.store') }}" 
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($leader))
                                    @method('PUT')
                                @endif

                                <div class="row clearfix">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label for="name_en">Name (EN)</label>
                                        <input type="text" name="name_en" id="name_en" class="form-control" 
                                               value="{{ old('name_en', $leader->name_en ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name_am">Name (AM)</label>
                                        <input type="text" name="name_am" id="name_am" class="form-control" 
                                               value="{{ old('name_am', $leader->name_am ?? '') }}" required>
                                    </div>

                                    <!-- Position -->
                                    <div class="col-md-6">
                                        <label for="position_en">Position (EN)</label>
                                        <input type="text" name="position_en" id="position_en" class="form-control" 
                                               value="{{ old('position_en', $leader->position_en ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="position_am">Position (AM)</label>
                                        <input type="text" name="position_am" id="position_am" class="form-control" 
                                               value="{{ old('position_am', $leader->position_am ?? '') }}" required>
                                    </div>

                                    <!-- Department -->
                                    <div class="col-md-6">
                                        <label for="department_en">Department (EN)</label>
                                        <input type="text" name="department_en" id="department_en" class="form-control" 
                                               value="{{ old('department_en', $leader->department_en ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="department_am">Department (AM)</label>
                                        <input type="text" name="department_am" id="department_am" class="form-control" 
                                               value="{{ old('department_am', $leader->department_am ?? '') }}" required>
                                    </div>

                                    <!-- Qualification -->
                                    <div class="col-md-6">
                                        <label for="qualification_en">Qualification (EN)</label>
                                        <input type="text" name="qualification_en" id="qualification_en" class="form-control" 
                                               value="{{ old('qualification_en', $leader->qualification_en ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qualification_am">Qualification (AM)</label>
                                        <input type="text" name="qualification_am" id="qualification_am" class="form-control" 
                                               value="{{ old('qualification_am', $leader->qualification_am ?? '') }}">
                                    </div>

                                    <!-- Experience Years -->
                                    <div class="col-md-6">
                                        <label for="experience_years">Experience (Years)</label>
                                        <input type="number" name="experience_years" id="experience_years" class="form-control" 
                                               value="{{ old('experience_years', $leader->experience_years ?? '') }}" min="0">
                                    </div>

                                    <!-- Email & Phone -->
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" 
                                               value="{{ old('email', $leader->email ?? '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" 
                                               value="{{ old('phone', $leader->phone ?? '') }}">
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control" required>
                                            <option value="management" {{ (old('category', $leader->category ?? '') == 'management') ? 'selected' : '' }}>Management</option>
                                            <option value="medical" {{ (old('category', $leader->category ?? '') == 'medical') ? 'selected' : '' }}>Medical</option>
                                            <option value="board" {{ (old('category', $leader->category ?? '') == 'board') ? 'selected' : '' }}>Board</option>
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="is_active" class="form-control show-tick" required>
                                            <option value="1" {{ (old('is_active', $leader->is_active ?? '') == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ (old('is_active', $leader->is_active ?? '') == 0) ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Photo -->
                                    <div class="col-md-12">
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                                        @if(isset($leader) && $leader->photo)
                                            <img src="{{ asset('storage/'.$leader->photo) }}" alt="Current Photo" class="mt-2" style="height:100px;">
                                        @endif
                                    </div>

                                    <!-- Bio -->
                                    <div class="col-md-6">
                                        <label for="bio_en">Bio (EN)</label>
                                        <textarea name="bio_en" id="bio_en" class="form-control" rows="3">{{ old('bio_en', $leader->bio_en ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bio_am">Bio (AM)</label>
                                        <textarea name="bio_am" id="bio_am" class="form-control" rows="3">{{ old('bio_am', $leader->bio_am ?? '') }}</textarea>
                                    </div>


                                </div>

                                <button type="submit" class="btn btn-primary btn-round mt-3">
                                    <i class="zmdi zmdi-check"></i> {{ isset($leader) ? 'Update Leadership Member' : 'Save Leadership Member' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('javascript')
<script src="/Smart/Admin/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
@stop
@endsection

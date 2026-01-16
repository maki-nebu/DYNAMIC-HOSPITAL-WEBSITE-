@extends('layouts.admin')
@section('title','Edit Accreditation')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/dropify/css/dropify.min.css">
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Accreditation</h2>
                    <a href="{{ route('admin.accreditations.index') }}" class="btn btn-primary btn-icon">
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
                            <form action="{{ route('admin.accreditations.update', $accreditation->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Title EN -->
                                    <div class="col-md-6">
                                        <label for="title_en">Title (EN)</label>
                                        <input type="text" class="form-control" name="title_en" value="{{ old('title_en', $accreditation->title_en) }}" required>
                                    </div>

                                    <!-- Title AM -->
                                    <div class="col-md-6">
                                        <label for="title_am">Title (AM)</label>
                                        <input type="text" class="form-control" name="title_am" value="{{ old('title_am', $accreditation->title_am) }}" required>
                                    </div>

                                    <!-- Description EN -->
                                    <div class="col-md-6 mt-3">
                                        <label for="description_en">Description (EN)</label>
                                        <textarea class="form-control" name="description_en" rows="3" required>{{ old('description_en', $accreditation->description_en) }}</textarea>
                                    </div>

                                    <!-- Description AM -->
                                    <div class="col-md-6 mt-3">
                                        <label for="description_am">Description (AM)</label>
                                        <textarea class="form-control" name="description_am" rows="3" required>{{ old('description_am', $accreditation->description_am) }}</textarea>
                                    </div>

                                    <!-- Issuing Organization EN -->
                                    <div class="col-md-6 mt-3">
                                        <label for="issuing_organization_en">Issuing Organization (EN)</label>
                                        <input type="text" class="form-control" name="issuing_organization_en" value="{{ old('issuing_organization_en', $accreditation->issuing_organization_en) }}" required>
                                    </div>

                                    <!-- Issuing Organization AM -->
                                    <div class="col-md-6 mt-3">
                                        <label for="issuing_organization_am">Issuing Organization (AM)</label>
                                        <input type="text" class="form-control" name="issuing_organization_am" value="{{ old('issuing_organization_am', $accreditation->issuing_organization_am) }}" required>
                                    </div>

                                    <!-- Issue Date -->
                                    <div class="col-md-6 mt-3">
                                        <label for="issue_date">Issue Date</label>
                                        <input type="date" class="form-control" name="issue_date" value="{{ old('issue_date', $accreditation->issue_date->format('Y-m-d')) }}" required>
                                    </div>

                                    <!-- Expiry Date -->
                                    <div class="col-md-6 mt-3">
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="date" class="form-control" name="expiry_date" value="{{ old('expiry_date', $accreditation->expiry_date ? $accreditation->expiry_date->format('Y-m-d') : '') }}">
                                    </div>

                                    <!-- Certificate ID -->
                                    <div class="col-md-6 mt-3">
                                        <label for="certificate_id">Certificate ID</label>
                                        <input type="text" class="form-control" name="certificate_id" value="{{ old('certificate_id', $accreditation->certificate_id) }}">
                                    </div>

                                    <!-- Order -->
                                    <div class="col-md-6 mt-3">
                                        <label for="order">Order</label>
                                        <input type="number" class="form-control" name="order" value="{{ old('order', $accreditation->order) }}">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mt-3">
                                        <label for="is_active">Status</label>
                                        <select class="form-control" name="is_active">
                                            <option value="1" {{ $accreditation->is_active == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $accreditation->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Logo Upload -->
<div class="col-md-6 mt-3">
    <label for="logo">Logo</label>
    <input type="file" name="logo" class="dropify" data-default-file="{{ $accreditation->logo ? asset('storage/accreditations/'.$accreditation->logo) : '' }}">
</div>

<!-- Certificate Upload -->
<div class="col-md-6 mt-3">
    <label for="certificate">Certificate (PDF)</label>
    <input type="file" name="certificate" class="dropify" data-default-file="{{ $accreditation->certificate ? asset('storage/'.$accreditation->certificate) : '' }}" data-allowed-file-extensions="pdf">
</div>

<!-- Featured Checkbox -->
<div class="col-md-6 mt-3">
    <label for="is_featured">Featured</label><br>
    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $accreditation->is_featured ? 'checked' : '' }}>
    <label for="is_featured" class="ms-2">Mark as Featured</label>
</div>


                                    <!-- Submit -->
                                    <div class="col-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-primary btn-round">Update Accreditation</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- body -->
                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- body_scroll -->
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

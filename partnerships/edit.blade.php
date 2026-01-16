@extends('layouts.admin')
@section('title','Edit Partnership')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/dropify/css/dropify.min.css" />
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Partnership</h2>
                    <a href="{{ route('admin.partnerships.index') }}" class="btn btn-primary btn-icon">
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
                            <form action="{{ route('admin.partnerships.update', $partnership->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group form-float">
                                    <label for="name_en">Name (English)</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                           value="{{ old('name_en', $partnership->name_en) }}" required>
                                </div>

                                <div class="form-group form-float mt-3">
                                    <label for="name_am">Name (Amharic)</label>
                                    <input type="text" class="form-control" id="name_am" name="name_am"
                                           value="{{ old('name_am', $partnership->name_am) }}" required>
                                </div>

                                <div class="form-group form-float mt-3">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="logo" name="logo" class="dropify"
                                           data-default-file="{{ $partnership->logo ? asset('storage/' . $partnership->logo) : '' }}"
                                           data-height="150">
                                    <small class="text-muted">Upload a new logo only if you want to replace the current one.</small>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Update Partnership</button>
                                <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary mt-4">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/plugins/dropify/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
@stop

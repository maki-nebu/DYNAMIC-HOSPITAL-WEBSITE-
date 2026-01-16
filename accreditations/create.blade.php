@extends('layouts.admin')
@section('title','Add New Accreditation')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add New Accreditation</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <a href="{{ route('admin.accreditations.index') }}" class="btn btn-primary btn-icon float-right">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg') <!-- For success/error messages -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Accreditation</strong> Information</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.accreditations.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="title_en">Title (EN)</label>
                                        <div class="form-group">
                                            <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter Title in English" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title_am">Title (AM)</label>
                                        <div class="form-group">
                                            <input type="text" name="title_am" id="title_am" class="form-control" placeholder="Enter Title in Amharic" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="description_en">Description (EN)</label>
                                        <div class="form-group">
                                            <textarea name="description_en" id="description_en" class="form-control" rows="3" placeholder="Enter Description in English" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description_am">Description (AM)</label>
                                        <div class="form-group">
                                            <textarea name="description_am" id="description_am" class="form-control" rows="3" placeholder="Enter Description in Amharic" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="issuing_organization_en">Issuing Organization (EN)</label>
                                        <div class="form-group">
                                            <input type="text" name="issuing_organization_en" id="issuing_organization_en" class="form-control" placeholder="Enter Issuing Organization in English" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="issuing_organization_am">Issuing Organization (AM)</label>
                                        <div class="form-group">
                                            <input type="text" name="issuing_organization_am" id="issuing_organization_am" class="form-control" placeholder="Enter Issuing Organization in Amharic" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="issue_date">Issue Date</label>
                                        <div class="form-group">
                                            <input type="date" name="issue_date" id="issue_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="expiry_date">Expiry Date</label>
                                        <div class="form-group">
                                            <input type="date" name="expiry_date" id="expiry_date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="certificate_id">Certificate ID</label>
                                        <div class="form-group">
                                            <input type="text" name="certificate_id" id="certificate_id" class="form-control" placeholder="Enter Certificate ID">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
    <label for="certificate">Certificate File (PDF/Image)</label>
    <div class="form-group">
        <input type="file" name="certificate" id="certificate" class="form-control" accept=".pdf,image/*">
    </div>
</div>

                                    <div class="col-md-6">
                                        <label for="logo">Logo</label>
                                        <div class="form-group">
                                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="order">Order</label>
                                        <div class="form-group">
                                            <input type="number" name="order" id="order" class="form-control" placeholder="Enter Display Order" value="0">
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label for="is_active">Status</label>
                                        <div class="form-group">
                                            <select name="is_active" id="is_active" class="form-control show-tick">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
    <label for="is_featured">Featured</label>
    <div class="form-group">
        <select name="is_featured" id="is_featured" class="form-control show-tick">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
</div>

                                </div>

                                <button type="submit" class="btn btn-primary btn-round">
                                    <i class="zmdi zmdi-check"></i> Save Accreditation
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

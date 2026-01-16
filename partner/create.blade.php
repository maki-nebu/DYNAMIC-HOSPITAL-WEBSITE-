@extends('layouts.admin')
@section('title','Add New Partner / Client')
@section('content')


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add New Partner / Client</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            @include('layouts.msg')
                            <form method="post" action="{{ route('admin.createPartner') }}" class="user" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Link" name="link" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="file" class="form-control" placeholder="Image" name="image" required>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">SUBMIT</button>
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
<!-- Jquery Core Js -->
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<!-- <script src="/Smart/Admin/assets/bundles/jvectormap.bundle.js"></script> -->
<script src="/Smart/Admin/assets/bundles/sparkline.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/c3.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/js/pages/index.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
@stop
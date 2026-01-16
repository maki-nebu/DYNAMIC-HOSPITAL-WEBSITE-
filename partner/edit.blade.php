@extends('layouts.admin')
@section('title','Edit Team')
@section('content')


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit Team</h2>
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
                            <form method="post" action="{{ route('admin.editTeam', $team->id) }}" class="user" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Name" value="{{ $team->name }}" name="name" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Title" value="{{ $team->title }}" name="title" required>
                                </div>
                                <div class="form-group form-float">
                                    <input type="file" class="form-control" placeholder="Photo" name="photo">
                                </div>
                                <div class="form-group form-float">
                                    <input type="link" class="form-control" placeholder="Facebook Link" value="{{ $team->facebook_link }}" name="facebook_link">
                                </div>
                                <div class="form-group form-float">
                                    <input type="link" class="form-control" placeholder="Twitter Link" value="{{ $team->twitter_link }}" name="twitter_link">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Phone Number" value="{{ $team->phone_number }}" name="phone_number">
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
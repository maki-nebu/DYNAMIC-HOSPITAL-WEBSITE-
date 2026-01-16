@extends('layouts.admin')
@section('title','Edit History')
@section('content')


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Edit History</h2>
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
                            <form method="post" action="{{ route('admin.updateHistory', $history->id) }}" class="user"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <input type="text" class="form-control" placeholder="Title" name="title"
                                                value="{{ $history->title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float clearfix">
                                            <select name="year" class="form-control">
                                                <?php
                                                $currentYear = date("Y");
                                                $startYear = $currentYear - 200;
                                                $endYear = $currentYear + 0;

                                                for ($year = $startYear; $year <= $endYear; $year++) {
                                                    echo "<option value=\"$year\">$year</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label class="clearfix">Director Photo</label>
                                            <input type="file" class="form-control" placeholder=""
                                                accept="image/jpeg, image/jpg, image/bmp, image/png, image/svg+xml, image/webp"
                                                name="image" required>
                                        </div>
                                        @if(is_array($history->image) ||
                                        is_object($history->image))
                                        @foreach($history->image as $key => $imagee)
                                        <img class="pre_serve" src="{{ asset('uploads/History/'.$imagename) }}"
                                            style="max-width: 100px;" alt="">
                                        @endforeach
                                        @else
                                        <img class="pre_serve" src="{{ asset('uploads/History/'.$history->image) }}"
                                            style="max-width: 100px;" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control ckeditor"
                                        value="">{{ $history->description }}</textarea>
                                </div>
                        </div>


                        <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()"
                            type="submit">SUBMIT</button>
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
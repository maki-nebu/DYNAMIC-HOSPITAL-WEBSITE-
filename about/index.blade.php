@extends('layouts.admin')
@section('title','About Page')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>About Page Entries</h2>
                    <a href="{{ route('admin.about.create') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-plus"></i> Add Entry
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg')
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Title (EN)</th>
                                            <th>Title (AM)</th>
                                            <th>Content (EN)</th>
                                            <th>Content (AM)</th>
                                            <th>Status / Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($abouts as $key=>$about)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ ucfirst($about->type) }}</td>
                                            <td>{{ $about->title_en }}</td>
                                            <td>{{ $about->title_am }}</td>
                                            <td>{{ $about->content_en }}</td>
                                            <td>{{ $about->content_am }}</td>
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-success btn-sm" title="Edit Entry">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.about.status', $about->id) }}" class="btn {{ $about->status ? 'btn-success' : 'btn-danger' }} btn-circle" title="Toggle Status">
                                                    <i class="zmdi zmdi-power"></i>
                                                </a>
                                                <a href="{{ route('admin.about.delete', $about->id) }}" class="btn btn-danger btn-circle" title="Delete Entry" onclick="return confirm('Are you sure?')">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('javascript')
<script src="/Smart/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="/Smart/Admin/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="/Smart/Admin/assets/bundles/mainscripts.bundle.js"></script>
<script src="/Smart/Admin/assets/js/pages/tables/jquery-datatable.js"></script>
@stop

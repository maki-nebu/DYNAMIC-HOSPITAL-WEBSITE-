@extends('layouts.admin')
@section('title','History')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>History</h2>
                    <a href="{{ route('admin.history.create') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-plus"></i>
                    </a>
                    <!-- <a href="{{ route('admin.trashedPartner') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-delete"></i>
                    </a> -->
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
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Year</th>
                                            <th>Last Modified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($histories as $key=>$history)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $history->title }}</td>
                                            <td>{{ $history->year }}</td>
                                            <td>{{ Carbon\Carbon::parse($history->updated_at)->format('F d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.editHistory',$history->id) }}" class="btn btn-success btn-circle">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <form id="delete-form-{{ $history->id }}" action="{{ route('admin.deleteHistory',$history->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $history->id }}').submit();
                                                }else {
                                                    event.preventDefault();
                                                        }"><i class="zmdi zmdi-delete"></i></button>
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
@endsection
@extends('layouts.admin')
@section('title','Trashed Partners / Clients')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Trashed Partners / Clients</h2>
                    <a href="{{ route('admin.partners') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-home"></i>
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
                                            <th>Name / Link</th>
                                            <th>Image</th>
                                            <th>Last Modified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($partners as $key=>$partner)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $partner->name }} <br> <a href="{{ $partner->link }}" target="_blank">{{ $partner->link}} </a> </td>
                                            <td><img class="img-responsive img-thumbnail" src="{{ asset('uploads/Partner/'.$partner->image) }}" style="height: 100px; width: 100px" alt=""></td>
                                            <td>{{ Carbon\Carbon::parse($partner->updated_at)->format('F d, Y') }}</td>
                                            <td>
                                                <form class="form-update" method="post" action="{{ route('admin.restorePartner', $partner->id) }}">
                                                    @method('patch')
                                                    @csrf
                                                    <button type="submit" onclick="this.form.submit()" class="btn btn-sm btn-success">
                                                        <i class="zmdi zmdi-refresh-alt"></i></a>
                                                    </button>
                                                </form>
                                                <form id="delete-form-{{ $partner->id }}" action="{{ route('admin.deletePartnerPermanent',$partner->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $partner->id }}').submit();
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
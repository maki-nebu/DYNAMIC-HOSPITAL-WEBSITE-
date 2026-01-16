@extends('layouts.admin')
@section('title','Accreditations')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop

@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>All Accreditations</h2>
                    @can('accreditation_create')
                    <a href="{{ route('admin.accreditations.create') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-plus"></i>
                    </a>
                    @endcan
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
            <!-- Accreditations Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable text-center align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Logo</th>
                                            <th>Title (EN)</th>
                                            <th>Title (AM)</th>
                                            <th>Issuing Organization (EN)</th>
                                            <th>Issuing Organization (AM)</th>
                                            <th>Issue Date</th>
                                            <th>Expiry Date</th>
                                            <th>Certificate ID</th>
                                            <th>Order</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($accreditations as $key => $accreditation)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if($accreditation->logo)
                                                    <img src="{{ asset('storage/accreditations/' . $accreditation->logo) }}" width="40" height="40" class="rounded-circle">
                                                @else
                                                    <span>No Logo</span>
                                                @endif
                                            </td>
                                            <td>{{ $accreditation->title_en }}</td>
                                            <td>{{ $accreditation->title_am }}</td>
                                            <td>{{ $accreditation->issuing_organization_en }}</td>
                                            <td>{{ $accreditation->issuing_organization_am }}</td>
                                            <td>{{ $accreditation->issue_date }}</td>
                                            <td>{{ $accreditation->expiry_date ?? '-' }}</td>
                                            <td>{{ $accreditation->certificate_id ?? '-' }}</td>
                                            <td>{{ $accreditation->order }}</td>
                                            <td>{{ $accreditation->is_active ? 'Yes' : 'No' }}</td>
                                            <td class="d-flex justify-content-center gap-1">
                                                @can('accreditation_edit')
                                                <a href="{{ route('admin.accreditations.edit', $accreditation->id) }}" class="btn btn-success btn-sm">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                @endcan
                                                @can('accreditation_delete')
                                                <form action="{{ route('admin.accreditations.destroy', $accreditation->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
                                                @endcan
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this accreditation?')) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>

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

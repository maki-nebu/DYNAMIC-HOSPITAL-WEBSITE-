@extends('layouts.admin')
@section('title','Leadership')
@section('css')
<link rel="stylesheet" href="/Smart/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>All Leadership</h2>
                    <a href="{{ route('admin.leadership.create') }}" class="btn btn-primary btn-icon">
                        <i class="zmdi zmdi-plus"></i>
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
            <!-- Leadership Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable text-center align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Name (EN)</th>
                                            <th>Position (EN)</th>
                                            <th>Department (EN)</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Category</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leadership as $key => $leader)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if($leader->photo)
                                                    <img src="{{ asset('storage/leadership/' . $leader->photo) }}" width="40" height="40" class="rounded-circle">
                                                @else
                                                    <span>No Photo</span>
                                                @endif
                                            </td>
                                            <td>{{ $leader->name_en }}</td>
                                            <td>{{ $leader->position_en }}</td>
                                            <td>{{ $leader->department_en }}</td>
                                            <td>{{ $leader->email }}</td>
                                            <td>{{ $leader->phone }}</td>
                                            <td>{{ ucfirst($leader->category) }}</td>
                                            <td>{{ $leader->is_active ? 'Yes' : 'No' }}</td>
                                            <td class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('admin.leadership.edit', $leader->id) }}" class="btn btn-success btn-sm">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.leadership.destroy', $leader->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </form>
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
                if (confirm('Are you sure you want to delete this leader?')) {
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

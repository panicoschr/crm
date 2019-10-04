@extends('layouts.admin_template')

@section('styles')
<link rel="stylesheet" href="admin-lte/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="admin-lte/dist/css/adminlte.min.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection

@section('content')
<div class="container ">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('sentence.userinforender')}}</h3>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Entity</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')

<script src="admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin-lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="admin-lte/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready( function () {
    $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{ route('api.user.info') }}",
    "columns": [
    { "data": "id" },
    { "data": "name" },
    { "data": "email" },
    { "data": "username" },
    { "data": "phone" },
    { "data": "entity" }
    ]
    });
    });
</script>
@endsection
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
    {{ csrf_field() }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ trans('sentence.userinfonorender')}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Action</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>************</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->phone}}</td>
                                <td><button class="edit-modal btn btn-info"
                                            data-info="{{$item->id}},{{$item->name}},{{$item->email}},{{$item->password}},{{$item->username}},{{$item->phone}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <textarea name="error" id="errorid" class="form-control">
                                    </textarea>                                    
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="id">ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Name</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email">
                                </div>                            
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="password">Password:</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="password">
                                </div>
                            </div>                                                
                            <div class="form-group">
                                <label class="control-label col-sm-2"  for="username">Username:</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="phone">Phone</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="phone">
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn actionBtn" data-dismiss="modal">
                                <span id="footer_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script src="admin-lte/plugins/jquery/jquery.min.js"></script>
<script src="admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin-lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="admin-lte/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function() {
    $('#table').DataTable();
    } );
</script>

<script>
    $(document).on('click', '.edit-modal', function() {
    $('#footer_action_button').text(" Update");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    var stuff = $(this).data('info').split(',');
    fillmodalData(stuff)
    $('#myModal').modal('show');  
    $("#errorid").hide();
    });

    function fillmodalData(details){
    $('#id').val(details[0]);
    $('#name').val(details[1]);
    $('#email').val(details[2]);
    $('#username').val(details[4]);
    $('#phone').val(details[5]);
     }
    
    $('.modal-footer').on('click', '.edit', function() {
    $.ajax({
    type: 'post',
    url: '/editItem',
    data: {
    '_token': $('input[name=_token]').val(),
    'id': $("#id").val(),
    'name': $('#name').val(),
    'email': $('#email').val(),
    'password': $('#password').val(),
    'username': $('#username').val(),
    'phone': $('#phone').val()
    },
    success: function(data) {
     location.reload() 
    },
      error: function(jqXhr, json, errorThrown){// this are default for ajax errors 
        var errors = jqXhr.responseJSON;
        var errorsHtml = '';
        $.each(errors['errors'], function (index, value) {
            errorsHtml += '' + value + '';
        });
        errorsHtml = 'Errors detected : ' + errorsHtml + ' ';
        $('#errorid').show();
        $('#myModal').modal('show'); 
        $('#errorid').val(errorsHtml);
    }
    });
    });

</script>

<script>
    $(function () {
    $("#datatable").DataTable();
    });
</script>
@endsection
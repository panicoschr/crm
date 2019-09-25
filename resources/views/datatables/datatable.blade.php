@extends('layouts.admin_template')

@section ('styles')
 <link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
 <link rel="stylesheet"
	href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endsection	  
    
@section('content')

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
	src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<div class="container ">
		{{ csrf_field() }}
		<div class="table-responsive text-center">
			<table class="table table-borderless" id="table">
				<thead>
					<tr>
						<th class="text-center">Id</th>
						<th class="text-center">Name</th>
						<th class="text-center">Email</th>
						<th class="text-center">Password</th>
						<th class="text-center">Username</th>
						<th class="text-center">Phone</th>
                                                <th class="text-center">Action</th>
					</tr>
				</thead>
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
			</table>
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
						<p class="name_error error text-center alert alert-danger hidden"></p>
                                                
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email">
							</div>
						</div>
						<p class="email_error error text-center alert alert-danger hidden"></p>
                                                
						<div class="form-group">
							<label class="control-label col-sm-2" for="password">Password:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="password">
							</div>
						</div>                                                
						<p class="password_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="username">Username:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="username">
							</div>
						</div>
						<p
						class="username_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="phone">Phone</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="phone">
							</div>
						</div>
						<p
							class="phone_error error text-center alert alert-danger hidden"></p>
					</form>
					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
							class="hidden did"></span>
					</div>
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
  
 @endsection  
 
 
@section('javascripts')

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
             		location.reload(); 
                     $('.error').addClass('hidden');
                $('.data' + data.id).replaceWith("<tr class='data" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.name +
                        "</td><td>" + "</td><td>" + data.email + "</td><td>" + data.password + "</td><td>" +
                         data.username + "</td><td>" + "</td><td>" + data.phone +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.name+","+data.email+","+data.password+","+data.username+","+data.phone+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.name+","+","+data.email+","+data.password+","+data.username+","+data.phone+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            	
                 
                 }
        });
    });

</script>





 @endsection
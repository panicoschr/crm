@extends('layouts.admin_template')

@section('content')
<div class="container">
<form action="/apis/update" method="POST">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update the API</div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="api" Placeholder="API KEY......" value="{{$api->api}}">
                        </div>
                        <div class="form-group text-center"> 
                            <button type="submit" class="btn btn-success">Update the API</button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection

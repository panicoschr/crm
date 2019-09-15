@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard for Admin</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                <div class="form-group text-center"> 
                    <a href="/apis/edit" class="btn btn-info my-2">API Management</a>     
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

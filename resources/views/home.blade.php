@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mini CRM</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="links">
                        <a href="/companies"><p>{{ trans('sentence.companies')}}</p></a>
                        <a href="/employees"><p>{{ trans('sentence.employees')}}</p></a>
                        <a href="/admin"><p>{{ trans('sentence.adminpanel')}}</p></a>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

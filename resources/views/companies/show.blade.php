@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company Details</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <ul class="list-group"> 
                        <li class="list-group-item">  
                            {{ $company->name }}
                        </li>   
                        <li class="list-group-item">  
                            {{ $company->email }}
                        </li>    
                        <li class="list-group-item">  
                            <img width="100px" src="{{ url($company->logo) }}" />    
                            {{ $company->logo }}
                        </li>   
                        <li class="list-group-item">  
                            {{ $company->url }}
                        </li>                      
                    </ul>     
                    <a href="/companies/{{ $company->id }}/edit" class="btn btn-info my-2">Edit</a>
                    <a href="/companies/{{ $company->id }}/delete" class="btn btn-danger my-2">Delete</a>                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


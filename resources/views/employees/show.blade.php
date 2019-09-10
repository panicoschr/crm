@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee Details</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                                <ul class="list-group"> 
       
                                <li class="list-group-item">  
                                    {{ $employee->first_name }}
                                </li>   
                                <li class="list-group-item">  
                                    {{ $employee->last_name }}
                                </li>    
                                  <li class="list-group-item">  
                                    {{ $employee->company->name }}
                                </li>   
                                  <li class="list-group-item">  
                                    {{ $employee->email }}
                                </li>                      
                                 <li class="list-group-item">  
                                    {{ $employee->phone }}
                                </li>   
                     
                            </ul>     



                    <a href="/employees/{{ $employee->id }}/edit" class="btn btn-info my-2">Edit</a>
                    <a href="/employees/{{ $employee->id }}/delete" class="btn btn-danger my-2">Delete</a>                 


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

  
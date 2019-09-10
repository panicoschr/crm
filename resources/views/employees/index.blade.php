@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employees List</div>

                        <div class="card-body">
                            <ul class="list-group"> 
                                @foreach ($employees as $employee)
                                <li class="list-group-item">  
                                    {{ $employee->first_name }}  {{ $employee->last_name }} {{ $employee->company->name }}      
                                    <a  href="/employees/{{$employee->id}}" class="btn btn-primary btn-sm float-right">Show</a>
                                </li>  
                                 @endforeach 
                                

                                  
                              
                              
                            </ul>   
                            
                    <a href="/employees/create" class="btn btn-info my-2">Create new Employee</a>     
                       <div class="row justify-content-center">
                     {{ $employees->links() }}
                      </div>
                        </div> 
            </div>
        </div>
    </div>

</div>
@endsection

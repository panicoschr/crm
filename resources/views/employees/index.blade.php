@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><p>{{ trans('sentence.emplist')}}</p></div>
                <div class="card-body">
                    <ul class="list-group"> 
                        @foreach ($employees as $employee)
                        <li class="list-group-item">  
                            <a href="/employees/{{$employee->id}}">{{ $employee->first_name }}  {{ $employee->last_name }} {{ $employee->company->name }}    </a>                         
                        </li>  
                        @endforeach 
                    </ul>      
                    <div class="row justify-content-center">
                        {{ $employees->links() }}
                    </div>
                </div> 
            </div>
        </div>
    </div>

</div>
@endsection

@extends('layouts.admin')

@section('content')
<form action="/employees/{{$employee->id}}/update" method="POST">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update an Employee</div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="first_name" Placeholder="First Name" value="{{$employee->first_name}}" required="true">
                        </div>
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="last_name" Placeholder="Last Name" value="{{$employee->last_name}}"required="true" >
                        </div>   

                        <div class="form-group">                   
                            <select class="form-control m-bot15" name="company_id">
                                @if($companies->count() > 0)
                                @foreach($companies as $company)
                                <option value="{{$company->id}}" {{ ($company->id == $employee->company->id) ? 'selected': '' }}>{{$company->name}}</option>
                                @endForeach
                                @else
                                No Record Found
                                @endif   
                            </select>                   
                        </div>                        
                        <div class="form-group"> 
                            <input type="email" class="form-control" name="email" Placeholder="Email" value="{{$employee->email}}">
                        </div> 
                        <div class="form-group"> 
                            <input type="number" class="form-control" name="phone" Placeholder="Phone" value="{{$employee->phone}}">
                        </div>                        
                        <div class="form-group text-center"> 
                            <button type="submit" class="btn btn-success">Update Employee</button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@extends('layouts.admin')

@section('content')



<form action="/employees" method="POST">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>{{ trans('sentence.newemp')}}</p></div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                <li class="list-group-item">
                                    {{ $error }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif             
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="first_name" Placeholder="First Name" required="true">
                        </div>
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="last_name" Placeholder="Last Name" required="true">
                        </div>      
                        <div class="form-group">                   
                            <select class="form-control m-bot15" name="company_id">
                                @if($companies->count() > 0)
                                @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endForeach
                                @else
                                No Record Found
                                @endif   
                            </select>                   
                        </div>                        
                        <div class="form-group"> 
                            <input type="email" class="form-control" name="email" Placeholder="Email">
                        </div> 
                        <div class="form-group"> 
                            <input type="number" class="form-control" name="phone" Placeholder="Phone">
                        </div>                        
                        <div class="form-group text-center"> 
                            <button type="submit" class="btn btn-success"><p>{{ trans('sentence.newemp')}}</p></button>
                        </div>                     
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@extends('layouts.app')

@section('content')
   <form action="/companies/{{$company->id}}/update" method="POST">
    @csrf
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Company</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    

                    
       <div class="form-group"> 
           <input type="text" class="form-control" name="name" Placeholder="Name" value="{{$company->name}}" required="true">
                        </div>
                     
                        <div class="form-group"> 
                            <input type="email" class="form-control" name="email" Placeholder="Email" value="{{$company->email}}">
                        </div> 
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="logo" Placeholder="Phone" value="{{$company->logo}}">
                        </div>      
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="url" Placeholder="Website" value="{{$company->url}}">
                        </div>                        
        
                         <div class="form-group text-center"> 
                            <button type="submit" class="btn btn-success">Update Company</button>
                        </div> 
                                       
   
                    
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

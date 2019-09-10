@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies List</div>

                        <div class="card-body">
                            <ul class="list-group"> 
                                @foreach ($companies as $company)
                                <li class="list-group-item">  
                                    {{ $company->name }}   
                                    <a  href="/companies/{{$company->id}}" class="btn btn-primary btn-sm float-right">Show</a>
                                </li>  
                                 @endforeach 
                              </ul>     
                    <a href="/companies/create" class="btn btn-info my-2">Create new Company</a>   
                       <div class="row justify-content-center">
                     {{ $companies->links() }}
                      </div>
                            
                        </div> 
            </div>
        </div>
    </div>
</div>
@endsection

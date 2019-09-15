@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><p>{{ trans('sentence.complist')}}</p></div>

                <div class="card-body">
                    <ul class="list-group"> 
                        @foreach ($companies as $company)
                        <li class="list-group-item">  
                             <a href="/companies/{{$company->id}}">{{$company->name}}</a>
                        </li>  
                        @endforeach 
                    </ul>     
                    <div class="row justify-content-center">
                        {{ $companies->links() }}
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

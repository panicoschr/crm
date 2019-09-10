@extends('layouts.app')

@section('content')


<form action="/companies" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a Company</div>

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
                            <input type="text" class="form-control" name="name" Placeholder="Name" required="true">
                        </div>
                        <div class="form-group"> 
                            <input type="email" class="form-control" name="email" Placeholder="Email">
                        </div> 
                       <div class="form-group">
                            <input type="file" class="form-control" name="logo" id="logo">
                        </div>
                          <div class="form-group"> 
                              <input type="text" class="form-control" name="url" Placeholder="Website">
                        </div>                         
                        <div class="form-group text-center"> 
                            <button type="submit" class="btn btn-success">Create a Company</button>
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

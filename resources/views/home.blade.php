@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                @php $locale = session()->get('locale'); @endphp                


                <ul>

                    <li>
                         @switch($locale)
                                @case('fr')
                                <img src="{{asset('img/fr.png')}}" width="30px" height="20x"> French
                                @break
                                @default
                                <img src="{{asset('img/uk.png')}}" width="30px" height="20x"> English
                                @endswitch
                        
                               <ul class="">
                            <li><a href="lang/en"><img src="{{asset('img/uk.png')}}" width="15px" height="10x">English</a></li>
                            <li><a href="lang/fr"><img src="{{asset('img/fr.png')}}" width="15px" height="10x">French</a></li>
                        </ul>
                    </li>                          
                </ul>
               
                    
                    
                    
                    
                    
                    
                </div>
                <div class="card-body">
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
@endsection

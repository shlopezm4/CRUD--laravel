@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    @foreach($comentario as $row)
    
    @if($loop->first)
    <div class="col-sm-4 col-md-12">
            <div class="thumbnail">
                <img src="http://lorempixel.com/1200/400/" >
                <div class="caption">
                    <h3>{{$row->title}}</h3>
                    <h4>{{$row->title}}</h4>
                    <p>{{ str_limit($row->body, 500)}}</p>
                </div>
            </div>
    </div> 
    @else
   <div class="col-sm-4 col-md-4">
            <div class="thumbnail">
                <img src="http://lorempixel.com/400/200/" >
                <div class="caption">
                    <h3>{{$row->title}}</h3>
                    <h4>{{$row->title}}</h4>
                    <p aling="justify">{{str_limit($row->body,200   )}}</p>
                </div>
            </div>
    </div>
     @endif
    
    @endforeach
    </div>
    {{$comentario->links()}}
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <h3>{{ $post->title }}</h3>
        <div>
          {!! $post->body !!}
          <p>Escrito por: {{ $post->user->name}}</p>
        </div>
        @if (Auth::check())
          @include('includes.errors')
          {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
          <div class="card my-4">
            <h5 class="card-header">Escribe tu comentario:</h5>
            <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="post_id" value="{{$post->id}}">
                  <textarea class="form-control" rows="3"name="body"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        {{ Form::close() }}
        @endif
         <!-- Comments Form -->
         <br>
        @forelse ($post->comments as $comment)
          <p>{{ $comment->user->name }} {{$comment->created_at}}</p>
          <p>{{ $comment->body }}</p>
          <hr>
        @empty
          <p>Sin Comentarios</p>
        @endforelse

    </div>
  </div>
</div>
@endsection
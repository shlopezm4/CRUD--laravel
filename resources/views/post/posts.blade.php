@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('posts.create')}}">agregar</a>
        {{ Form::open(['route' => ['posts.index'], 'method' => 'GET']) }}
          {{ Form::text('search', Input::old('search'), array('placeholder'=>'Search')) }}
          {{ Form::submit('Search') }}
        {{ Form::close() }}
        
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>titulo</th>
      <th>comentarios</th>
      <th>Username</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  @forelse ($posts as $post)
  <tr>
    <th>#</th>
    <th>{{ $post->title }}</th>
    <th>{{$post->comments->count()}} comentario</th>
    <th>{{ $post->user->name }} - {{ $post->created_at }}</th>
    <th> <a href="{{URL::to('/')}}/post/{{ $post->id }}">Go</a></th>
    @if (Auth::check() && ($post->user_id == Auth::id() || Auth::user()->hasRole('administrator')))
           <th> <a href="{{URL::to('/')}}/post/{{ $post->id }}/edit">Edit</a></td>
           <th><form action="{{URL::to('/')}}/post/{{ $post->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form></th>
          @endif  
  </tr>
  @empty
  <p>No Existen post</p>
  @endforelse
</tbody>    
</table>
{{$posts->links()}}

        
 
       



 
           
            
        

        <!--h3>Active users</h3>
        @forelse ($active_users as $user)
            <p>{{ $user->name }} ({{ $user->last_login->diffForHumans() }})</p>
        @empty
          <p>No users</p>
        @endforelse
-->
    </div>
  </div>
</div>
@endsection

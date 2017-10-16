@extends('layouts.app')

@section('content')
<div class="container">
@if (Auth::check() && Auth::user()->hasPermissionTo('post_create'))
<h4>Create post</h4>
@include('includes.errors')
<form id="save_post" method="post" action="{{URL::to('/')}}/posts">
  {{ csrf_field() }}
  <div>
    <p>Title</p>
    <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}">
  </div>
  
  <div>
    <p>Body</p>
    <textarea class="textarea-wysiwyg" class="form-control" id="body" name="body">{{ old('body') }}</textarea>
  </div>
  
  <div>
    <input type="submit"  value="Save">
  </div>
</form>
@endif
</div>
@endsection
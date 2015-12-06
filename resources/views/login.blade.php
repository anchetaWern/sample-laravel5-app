@extends('layouts.default')

@section('title')
<title>login</title>
@stop

@section('content')
<h1>login</h1>
{{--
the extends function allows this view to inherit from another view
layouts.default is the name of the view to inherit from
'layouts' as the folder inside the resources/views folder 
and 'default' as the name of the file
so the actual path is resources/views/layouts/default.blade.php
--}}
<form method="POST" action="/login">
  @include('partials.alert')
  {{-- always include this in all your forms to prevent cross-site request forgery --}}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
  <div class="row">
    <div class="twelve columns">
      <label for="email">Email</label>
      <input class="u-full-width" type="email" name="email" placeholder="test@mailbox.com" id="email">
    </div>

    <div class="twelve columns">
      <label for="password">Password</label>
      <input class="u-full-width" name="password" type="password" id="password">
    </div>
    
  	<button class="button-primary">Login</button>
</form>

@stop
@extends('layouts.default')

@section('content')
<h1>Create User</h1>
@include('partials.alert')
<form method="POST" action="/user/create">

  {{-- always include this in all your forms to prevent cross-site request forgery --}}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
  <div class="row">
    <div class="twelve columns">
      <label for="email">Email</label>
      <input class="u-full-width" type="email" name="email" placeholder="test@mailbox.com" id="email" value="{{ old('email') }}">
    </div>
  </div>  

  <div class="row">    
    <div class="twelve columns">
      <label for="password">Password</label>
      <input class="u-full-width" name="password" type="password" id="password">
    </div>
  </div>
    
  <button class="button-primary">Create</button>
</form>

@stop
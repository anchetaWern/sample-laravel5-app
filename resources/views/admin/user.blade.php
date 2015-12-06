@extends('layouts.default')

@section('content')
<h1>Update User</h1>
@include('partials.alert')
<form method="POST" action="/user/update">

  {{-- always include this in all your forms to prevent cross-site request forgery --}}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="id" value="{{ $user->id }}">

  <div class="row">
    <div class="twelve columns">
      <label for="email">Email</label>
      <input class="u-full-width" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
    </div>
  </div>  

  <div class="row">    
    <div class="twelve columns">
      <label for="password">Password</label>
      <input class="u-full-width" name="password" type="password" id="password">
    </div>
  </div>
    
  <button class="button-primary">Update</button>
</form>

@stop
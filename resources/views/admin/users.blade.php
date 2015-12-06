@extends('layouts.default')

@section('title')
<title>Users</title>
@stop


@section('jquery_script')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
@stop

@section('sweetalert_style')
<link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
@stop

@section('sweetalert_script')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
@stop

@section('users_script')
<script src="{{ asset('assets/js/users.js') }}"></script>
@stop

@section('content')
<h1>Users</h1>
<form action="/users" method="GET">
  <div class="row">
    <div class="six columns">
      <label for="email">Email</label>
      <input class="u-full-width" type="text" name="email" placeholder="query here" id="email" value="{{ request('email') }}">
    </div>
  </div>

  <button class="button-primary">Search</button> 
</form>

@if(count($users) > 0)
<div class="row">
	<div class="twelve columns">
		<table>
			<thead>
				<tr>
					<th>email</th>
					<th>update</th>
					<th>delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->email }}</td>
					<td>
						<a href="/user/{{ $user->id }}">update</a>
					</td>
					<td>
						<button class="button-danger delete-user" data-id="{{ $user->id }}" data-token="{{ $token }}" class="delete-user">delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@else
	<div class="alert alert-info">
		Your query didn't return any result
	</div>
@endif

@stop
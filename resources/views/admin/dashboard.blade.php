@extends('layouts.default')

@section('title')
<title>Dashboard</title>
@stop

@section('content')
<h1>What do you want to do?</h1>
<ul>
	<li><a href="/user/create">create user</a></li>
	<li><a href="/users">list users</a></li>
	<li><a href="/logout">logout</a></li>
</ul>
@stop
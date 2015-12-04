<!DOCTYPE html>
{{--
the main view in which all the other views extends from
this contains the links to the stylesheets used in all the page 
--}}
<html lang="en">
<head>
	<meta charset="UTF-8">
	@yield('title')
	<link rel="stylesheet" href="{{ url('assets/css/skeleton.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body>
	<div id="wrapper">
		@yield('content')
	</div>
	{{--
	the '@yield' function allows you to output a specific
	section that was defined in the child view (views/login.blade.php)
	you can define as many sections as you want in the child view
	and output it inside this view by calling the @yield function.

	in this page we've outputted the 'title' section which
	contains the title of the current page
	and the content section which contains the main content of the
	current page
	--}}
</body>
</html>
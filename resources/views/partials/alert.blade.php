{{-- 
check if there's any custom message that was flashed in the session.
Custom messages are being passed from the controller, see 
--}}
@if(session('message'))
	<div class="alert alert-{{ session('message.type') }}">
		{{ session('message.text') }}
	</div>
@endif

{{-- 
this checks if there are any errors that's flashed in the session 

--}}
@if($errors->any())
    <div class="alert alert-danger">
        {{-- loop through all the errors and output it inside a list item --}}
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

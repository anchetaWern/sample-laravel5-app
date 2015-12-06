$(function(){

	$('.delete-user').click(function(){

		var self = $(this);

		var id = self.data('id');
		var token = self.data('token');

		//submit the data via ajax
		$.post(
			'/user/delete/',
			{
				'id': id,
				'_token': token
			},
			function(response){
				if(response == 'ok'){
					swal('Awesome!', 'You have deleted the user', 'success');
				}else{
					swal('Ooops..', 'Something went wrong. Please try again', 'error');
				}

				self.parents('tr').fadeOut();
			}
		);


	});

});
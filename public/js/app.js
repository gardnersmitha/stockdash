$(document).ready(function(){


	$('.instance-panel-item').click(function(){

		
		//alert($(this).data('symbol'));
		
		var symbol_url = 'symbol/'+$(this).data('symbol')+'?partial=1';
		
		var symbol_content = $.get(symbol_url)

			.done(function(response){
				$('#symbol-panel').html(response);
			})

			.fail(function(response){
				alert(response);
				console.log(response);
			})

			.always(function(response){
				console.log(response);
			});

	});


});
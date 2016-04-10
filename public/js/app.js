$(document).ready(function(){


	$('.instance-panel-item').click(function(){

		
		var symbol = $(this).data('symbol');
		
		var symbol_url = 'symbol/'+$(this).data('symbol')+'?partial=1';
		
		var symbol_content = $.get(symbol_url)

			.done(function(response){
				$('#symbol-panel').html(response);
			})

			.fail(function(response){
				alert(response);
				console.log(response);
			})

			.then(function(response){
				var chartwidget = $('#tv-chart-widget').html();
				//$('#chart-container').html(chartwidget);
			})

			.always(function(response){
				console.log(response);
			});
	});


	$('.bulk-dimsiss').click(function(){

		var instances = $(this).data('instances');

		if(! confirm('Dismiss'+instances.length+' instances?')){
			return false;
		}

		var bulk_dismiss = $.post('instances/bulk', {'instances':instances})

			.done(function(response){
				alert(response);
			})

			.fail(function(response){
				alert(response);
				console.log(response);
			})

			.then(function(response){
				//
			})

			.always(function(response){
				console.log(response);
			});
	});


});
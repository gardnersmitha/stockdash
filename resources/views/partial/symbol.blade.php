<div id="chart-container" class="row">
	<!-- chart for {{ $symbol->symbol }} -->
	<!-- TradingView Widget BEGIN -->
		<script>
			// new TradingView.widget({
			// 	  "container_id":"chart-container",
			// 	  "autosize": true,
			// 	  "symbol": "{{ $symbol->symbol }}",
			// 	  "interval": "D",
			// 	  "timezone": "Etc/UTC",
			// 	  "theme": "White",
			// 	  "style": "1",
			// 	  "locale": "en",
			// 	  "toolbar_bg": "#f1f3f6",
			// 	  "hide_side_toolbar": false,
			// 	  "allow_symbol_change": true,
			// 	  "details": true, 
			// 	  "calendar": true,
			// 	  "hideideas": true,
			// 	  "news": [
			// 	  	"headlines"
			// 	  ],
			// 	  "studies": [
			// 	    "MASimple@tv-basicstudies"
			// 	  ],
			// 	  "show_popup_button": true,
			// 	  "popup_width": "1000",
			// 	  "popup_height": "650"
			// });
		</script>
	<!-- TradingView Widget END -->
</div>

<?php
	// TODO - make this more generic by grabbing any instance without an action
	// TODO - make reordering/flipping something that happens by default on the symbol's instances() method

	//Pop the last (most recent) instance off the collection
	$instances = collect($symbol->instances);

	$instance = $instances->pop();
	
	//Flip our array
	$instances = $instances->reverse();

?>

<!-- Include our form for the latest instance -->
@include('instance.update')


<ul class="list-group row">

	<!-- Past Instances List -->
	@foreach ($instances as $instance)

    	@include('partial.instance-detail')

	@endforeach
</ul>
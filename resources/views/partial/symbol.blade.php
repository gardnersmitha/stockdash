<div id="chart-container" class="row">

	{{ $symbol->symbol }}
<!-- 	<iframe id="tv-iframe" src="https://tradingview.com/chart?symbol={{ $symbol->symbol }}"></iframe>
 -->
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
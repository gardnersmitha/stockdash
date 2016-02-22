<div id="chart-container" class="row">
	<!-- chart for {{ $symbol->symbol }} -->
	<!-- TradingView Widget BEGIN -->
		<script>
			new TradingView.widget({
				  "container_id":"chart-container",
				  "autosize": true,
				  "symbol": "{{ $symbol->symbol }}",
				  "interval": "D",
				  "timezone": "Etc/UTC",
				  "theme": "White",
				  "style": "1",
				  "locale": "en",
				  "toolbar_bg": "#f1f3f6",
				  "hide_side_toolbar": false,
				  "allow_symbol_change": true,
				  "details": true, 
				  "calendar": true,
				  "hideideas": true,
				  "news": [
				  	"headlines"
				  ],
				  "studies": [
				    "MASimple@tv-basicstudies"
				  ],
				  "show_popup_button": true,
				  "popup_width": "1000",
				  "popup_height": "650"
			});
		</script>
	<!-- TradingView Widget END -->
</div>

<?php
	// TODO - make this more generic by grabbing any instance without an action
	// TODO - make reordering flipping something that happens by default on the symbol's instances() method

	//Pop the last (most recent) instance off the collection

	$latest_instance = $symbol->instances->pop();

	//Flip our array
	$instances_desc = $symbol->instances->sortByDesc('created_at');

?>

<!-- Live Instance Item/Form -->
<form class="row" action="/instance/{{ $latest_instance->id }}" method="POST" style="overflow:auto;">

	{{ method_field('PUT') }}

	<div class="col-xs-2">
		{{ date_format($latest_instance->created_at, 'M j, y') }}
		<p class="small">{{ $latest_instance->source_name }}</p>
	</div>

	<div class="col-xs-8">

		<!-- First row of form -->
		<div class="row">

			<div class="form-group col-xs-6 p-l-0">

				<label class="sr-only" for="sentiment">Sentiment</label>

				<select class="form-control form-control-sm c-select" name="sentiment">
				  <option value="bullish">Bullish</option>
				  <option value="neutral" selected>Neutral</option>
				  <option value="bearish">Bearish</option>
				</select>

			</div>

			<div class="form-group col-xs-6 p-x-0">

				<label class="sr-only" for="action">Action</label>

				<select class="form-control form-control-sm c-select" name="action">
				  <option value="remind_1D" selected>Remind(1d)</option>
				  <option value="remind_7D">Remind(1w)</option>
				  <option value="remind_30D">Remind(1m)</option>
				  <option value="dismiss">Dismiss</option>
				</select>
			</div>

		</div>

		<!-- Second row of form -->
		<div class="row">

			<div class="form-group">

				<label class="sr-only" for="note">Note</label>

				<textarea class="form-control form-control-sm" id="exampleTextarea" rows="2" name="note" placeholder="What are we thinking?"></textarea>

			</div>

			<div class="form-group">
				
				<label class="sr-only" for="chart_url">Chart URL</label>

				<input type="text" class="form-control form-control-sm" name="chart_url" placeholder="Chart URL">
			</div>

		</div>

	</div>

	<div class="col-xs-2">
		<button type="submit" class="btn btn-sm btn-primary form-control form-control-sm">Submit</button>
	</div>
</form>

<ul class="list-group row">
	<!-- Past Instances List -->
	@foreach ($instances_desc as $instance)

    <li class="list-group-item col-xs-12" style="overflow:auto;">
   		
   		<!-- Top Row, will be displayed by default -->
   		<div class="row">

   			<!-- Instance Meta -->
   			<div class="col-xs-2">
   				{{ date_format($instance->created_at, 'M j, y') }}
				<p class="small m-y-0">{{ $instance->symbol->symbol }} | ID: {{ $instance->id }}</p>
   			</div>

   			<!-- Instance Action Details  -->
   			<div class="col-xs-8">
   				<span>{{ $instance->sentiment}} </span>
   				<span>{{ $instance->action}} </span>
   			</div>

   			<!-- Instance Controls -->
   			<div class="col-xs-2">
   				<i class="fa-pencil"></i>
   			</div>

		</div>

		<div class="row">

			<div class="col-xs-8 col-offset-2">
				{{ $instance->note }}
			</div>
			
		</div>
    </li>

	@endforeach
</ul>
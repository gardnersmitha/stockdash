<!-- Live Instance Item/Form -->
<form class="row p-t-1 instance-update" action="/instance/{{ $instance->id }}" method="POST">

	{{ method_field('PUT') }}

	<!-- First row of form -->
		<div class="col-xs-2">

			<span class="font-weight-bold">{{ date_format($instance->created_at, 'M j, Y') }}</span>
         	<p class="small">{{ $instance->source_name }}</p>

      	</div>

		<div class="form-group col-xs-1 p-l-0">

			<label class="sr-only" for="sentiment">Sentiment</label>
			<input type="text" class="form-control form-control-sm" name="sentiment" placeholder="Sentiment">

		</div>

		<div class="form-group col-xs-1 p-x-0">

			<label class="sr-only" for="action">Action</label>				
			<input type="text" class="form-control form-control-sm" name="action" placeholder="Action">

		</div>

		<div class="form-group col-xs-4">

			<label class="sr-only" for="note">Note</label>

			<input type="text" class="form-control form-control-sm" id="exampleTextarea" name="note" placeholder="What are we thinking?">

		</div>

		<div class="form-group col-xs-2">
			
			<label class="sr-only" for="chart_url">Chart URL</label>

			<input type="text" class="form-control form-control-sm" name="chart_url" placeholder="Chart URL">
		</div>

		<div class="col-xs-2">
			<button type="submit" class="btn btn-sm btn-primary form-control form-control-sm">Submit</button>
		</div>

</form>
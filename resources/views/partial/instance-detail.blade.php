<!--  -->

<li class="list-group-item col-xs-12 instance-detail {{$instance->sentiment}}" id="instance-detail-{{ $instance->id }}">
	
	<!-- Top Row, will be displayed by default -->
	<div class="row">

		<!-- Instance Meta -->
		<div class="col-xs-2">

			<span class="font-weight-bold">{{ date_format($instance->created_at, 'M j, Y') }}</span>
         <p class="small m-y-0">{{ $instance->source_name }}</p>

      </div>

		<!-- Instance Action Details  -->
		<div class="col-xs-1 instance-detail-sentiment">
			<span> {{ studly_case($instance->sentiment) }} </span>
		</div>

      <div class="col-xs-1 instance-detail-action">
         <span> {{ studly_case($instance->action) }} </span>
      </div>

      <div class="col-xs-6 instance-detail-note">
         {{ $instance->note }}
      </div>

		<!-- Instance Controls -->
		<div class="col-xs-2 instance-detail-controls">
			<i class="fa fa-pencil p-x-1"></i>
         <i class="fa fa-camera p-x-1"></i>
		</div>

   </div>
</li>
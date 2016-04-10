@extends('app')

@section('content')

    <main id="dash-container" class="row">
        {{-- Display Validation Errors --}}

        <div id="instance-panel" class="col-xs-2 container">

        	@foreach ($instances as $instance_group_name => $instance_group_instances)

            <div class="list-group-heading list-group-item row" data-toggle="collapse" data-target="#{{ str_slug($instance_group_name,"-") }}-instances">
                {{ $instance_group_name }}

            </div>

            <ul id="{{ str_slug($instance_group_name,"-") }}-instances" class="list-group row collapse in">

                <!-- Dismiss All -->
                <li class="list-group-item">
                    <a class="bulk-dimsiss" data-instances="{{ collect($instance_group_instances) }}">Dismiss All</a>
                </li>

                @foreach ($instance_group_instances as $instance)

			    <li class="instance-panel-item list-group-item" data-symbol="{{ $instance->symbol->symbol }}">
			    	
			    	{{ $instance->symbol->symbol }}

			    	<span class="label label-default label-pill pull-xs-right">
			    		{{ $instance->source_type }}
			    	</span>

			    </li>

                @endforeach

            </ul>

			@endforeach

        </div>

        <div id="symbol-panel" class="col-xs-10">

        	<?php  $symbol = $instances->first()->first()->symbol; ?>
        	
        	@include('partial.symbol')

        </div>
        



    </main>

@endsection

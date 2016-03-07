@extends('app')

@section('content')

    <main id="dash-container" class="row">
        {{-- Display Validation Errors --}}

        <div id="instance-panel" class="col-xs-2 container">
        	<ul class="list-group row">

        	@foreach ($instances as $instance)

			    <li class="instance-panel-item list-group-item" data-symbol="{{ $instance->symbol->symbol }}">
			    	
			    	{{ $instance->symbol->symbol }}

			    	<span class="label label-default label-pill pull-xs-right">
			    		{{ $instance->source_type }}
			    	</span>

			    </li>

			@endforeach

			</ul>

        </div>

        <div id="symbol-panel" class="col-xs-10">

        	<?php  $symbol = $instances->first()->symbol; ?>
        	
        	@include('partial.symbol')

        </div>
        



    </main>

    {{-- TODO: Current Tasks --}}
@endsection

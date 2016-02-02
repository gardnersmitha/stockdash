

@extends('app')

@section('content')

    <main id="dash-container" class="row">
        {{-- Display Validation Errors --}}

        <div id="instance-panel" class="col-xs-3">
        	<ul class="list-group">

        	@foreach ($instances as $instance)

			    <li class="list-group-item">{{ $instance->symbol->symbol }}</li>

			@endforeach

			</ul>

        </div>

        <div id="symbol-panel" class="col-xs-9">
        	Symbol Details
        </div>
        



    </main>

    {{-- TODO: Current Tasks --}}
@endsection

@section('instance-form')

        {{-- New Instance Form --}}
        <form action="/instance" method="POST" class="form-inline pull-xs-right">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="text" name="symbol" id="instance-symbol" class="form-control" placeholder="ex. AAPL">
                <input type="hidden" name="source_type" value="manual">
                <input type="hidden" name="source" value="StockDash">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Symbol
                </button>
            </div>
        </form>

@endsection
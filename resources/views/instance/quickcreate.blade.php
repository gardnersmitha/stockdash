

        {{-- New Instance Form --}}
        <form action="/instance" method="POST" class="form-inline pull-xs-right">
            {{ csrf_field() }}
            <input type="hidden" name="source_type" value="manual">
            <input type="hidden" name="source" value="StockDash">

            <input type="text" class="form-control form-control-sm" name="symbol" id="instance-symbol" placeholder="ex. AAPL">

            <button type="submit" class="form-control form-control-sm btn btn-sm btn-default">
                <i class="fa fa-plus"></i> Add Symbol
            </button>

        </form>
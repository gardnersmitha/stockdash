
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>StockDash - Local</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>

    </head>

    <body>
        <div id="app" class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
                    <a class="navbar-brand" href="#">Stockdash</a>

                    @include('instance.quickcreate')

                </nav>
            </div>

             @yield('content')

        </div>
        <script src="{{ URL::asset('js/app.js') }}" type="text/javascript" charset="utf-8" async defer></script>
    </body>
</html>
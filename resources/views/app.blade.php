
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>StockDash - Local</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>

    </head>

    <body>
        <div id="app" class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-light bg-faded">
                    <a class="navbar-brand" href="#">Stockdash</a>

                    @include('instance.create')
                    @yield('instance-form')

                </nav>
            </div>

             @yield('content')

        </div>
        <script src="{{ URL::asset('js/app.js') }}" type="text/javascript" charset="utf-8" async defer></script>
    </body>
</html>
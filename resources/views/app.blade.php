
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>StockDash - Local</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
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
    </body>
</html>
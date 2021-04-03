<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEPSEM | @yield('pagename')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/logos/cepsem-simple.png') }}">
</head>

<body>
    @if (session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <div id="app">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>



</html>

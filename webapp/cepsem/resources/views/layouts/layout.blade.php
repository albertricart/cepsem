<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cepsem | @yield('pagename')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/logos/cepsem-simple.png') }}">
</head>

<body>

    <div id="app">
        @yield('header')
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>



</html>

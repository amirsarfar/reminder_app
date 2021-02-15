<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @yield('head')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
    <!-- production version, optimized for size and speed 
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <!-- development version, includes helpful console warnings -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    @yield('scripts')
</html>
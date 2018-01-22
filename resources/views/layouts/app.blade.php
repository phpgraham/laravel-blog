<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.header')
</head>
<body>
    <div id="app">
        @include('includes.navbar')

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="js/holder.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('admin.includes.header')
</head>
<body>
    <div id="app">
        @include('admin.includes.navbar')

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
</body>
</html>

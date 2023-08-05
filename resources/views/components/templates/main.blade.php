<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.ts'])

    @yield('assets')
</head>

<body class="preview antialiased">
    <div class="hero min-h-screen">
        <div class="hero-content min-w-[50vw] text-center">
            @yield('content')
        </div>
    </div>
    <footer>
        @yield('footer')
    </footer>
</body>

</html>

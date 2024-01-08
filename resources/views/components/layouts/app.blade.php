<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page 1Title' }}</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <liveiwre:Styles>
    </head>
    <body>
    <div class="container">

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    <liveiwre:scripts>
    </body>
</html>

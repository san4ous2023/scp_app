<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>observation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <link rel="stylesheet" href="{{ asset('css/app-041e359a.css') }}">--}}
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container">

    <nav class="navbar navbar-expand-md ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SCP App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route('home')}}">Main</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('observation.index')}}">Observation</a></li>
                    {{--                    <li class="nav-item"><a class="nav-link" href = "{{route('job.index')}}">Jobs</a></li>--}}
                    @can('view', auth()->user())
                        <li class="nav-item"><a class="nav-link" href="{{route('admin.observation.index')}}">Admin
                                Panel</a></li>
                    @endcan

                </ul>
            </div>
        </div>
    </nav>
    @include('includes.elements.flash-message')
    @yield('content')

</div>
</body>
</html>


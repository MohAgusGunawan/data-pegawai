<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @include('partial.style')
</head>
<body>
    <div class="container">
        <div class="sidebar">
            @include('partial.sidebar')
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    
    <div class="footer">
        @include('partial.footer')
    </div>

    @include('partial.script')
</body>
</html>

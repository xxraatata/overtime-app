<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Employee Self Service Politeknik Astra')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('styles')
</head>
<body>
    <div class="layout">
        @include('layouts.Header.Header')
        @include('layouts.Navbar.Navbar')
        
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html> 
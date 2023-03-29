<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @includeIf('layouts.head')

    <body class="antialiased">
        
        @yield('container')

    </body>
</html>


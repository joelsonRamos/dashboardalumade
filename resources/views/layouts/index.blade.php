

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @includeIf('Home.layout.head')

    <body class="antialiased">
        
        @yield('container')

    </body>
</html>


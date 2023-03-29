<!DOCTYPE html>
<html lang="pt-br">
    @includeIf('layouts.head')
    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper iframe-mode" data-widget="iframe">

            @includeIf('layouts.header')

            @includeIf('layouts.sidebar')

            @yield('content')

        </div>
        <!-- /.content-wrapper -->
            @include('layouts.footer')

            @include('layouts.javascript')

            @include('layouts.javascriptfuncao')

    </body>

</html>

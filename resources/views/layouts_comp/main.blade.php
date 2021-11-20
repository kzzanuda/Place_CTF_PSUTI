<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        @include('layouts.meta')
        @yield('styles')
    </head>
    <body class="d-flex flex-column h-100">
      @include('layouts.nav')

      @yield('content')

      @include('layouts.footer')

      <script src="{{ asset('js/app.js') }}"></script>
      @yield('sripts')
    </body>
</html>
